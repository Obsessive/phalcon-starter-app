<?php

namespace app\services;

use Phalcon\Config;
use Phalcon\Http\Request;
use Phalcon\Logger\Adapter\File as Log;
use Phalcon\Session\Adapter\Files as Session;
use app\models\UserPages;
use app\services\UserService;
use Facebook\Facebook;

class FacebookService
{
    /**
     * @var Facebook
     */
    protected $fb;

    /**
     * @var Phalcon\Config
     */
    protected $config;

    /**
     * @var Phalcon\Logger\Adapter\File as Log
     */
    protected $logger;

    /**
     * @var app\services\UserService
     */
    protected $userService;

    /**
     * @var use Phalcon\Session\Adapter\Files as Session
     */
    protected $session;

    /**
     * string access_token;
     */
    private $access_token;

    public function __construct( Facebook $fb, Config $config, Log $log, UserService $us, Session $session )
    {
        $this->fb = $fb;
        $this->config = $config;
        $this->logger = $log;
        $this->userService = $us;
        $this->session = $session;

        if ($this->session->get('accessToken') && !$this->access_token) {

            $this->access_token = $this->session->get('accessToken');
            $this->fb->setDefaultAccessToken($this->access_token);
        }
    }

    /**
     * Generates login url, use on index page
     * 
     * @return string
     */
    public function getLoginUrl()
    {
        $perms = ['user_location', 'manage_pages'];
        $callback = $this->config->application->host.'/auth/callback';

        return $this->fb->getRedirectLoginHelper()
                        ->getLoginUrl($callback, $perms);
    }

    /**
     * Get access token from Facebook callback and save it to session for future use
     */
    public function getAccessTokenFromCallback()
    {
        try {
            $access_token = $this->fb->getRedirectLoginHelper()
                              ->getAccessToken();

            $this->session->set('accessToken', $access_token);
            return $access_token;

        } catch(\Exception $e) {
           $this->handleError($e);
        }
    }

    /**
     * Get Facebook user with session saved access token
     */
    public function getFacebookUser($access_token)
    {
        if (! $this->session->get('access_token')) {
            $this->session->set('accessToken', $access_token);
        }

        try {
            return $this->fb->get('/me?fields=name,first_name,last_name,email,location,picture.type(large),cover.type(large)', $access_token)->getGraphUser();
               
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

    /**
     * Get user pages (Musician/Band)
     */
    public function getUserPages()
    {
        $user = $this->userService->getCurrentUser();
        if (! $user) {
            return null;
        }

        try {
            return $this->fb->get('/me/accounts')->getGraphEdge();

        } catch(\Exception $e) {
           $this->handleError($e);
        }
    }

    /**
     * Get basic page details from Facebook
     */
    public function getPageData($facebookPageId)
    {
        try {
            $query = '/'.$facebookPageId.'?fields=id,picture.type(large),cover.type(large),likes,genre,category';
            return $this->fb->get($query)->getGraphPage();
               
        } catch (\Exception $e) {
           $this->handleError($e);
        }
    }

    public function getPageEvents($facebookPageId)
    {
        try {
            $query = '/'.$facebookPageId.'?fields=events';
            return $this->fb->get($query)->getGraphNode();
               
        } catch (\Exception $e) {
           $this->handleError($e);
        }   
    }

    public function handleError(\Exception $e)
    {
        $this->logger->error('Message: ' . $e->getMessage());
        $this->logger->error('Error trace: ' . $e->getTraceAsString());
    }


}
