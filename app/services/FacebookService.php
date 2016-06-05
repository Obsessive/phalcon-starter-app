<?php

namespace app\services;

use Phalcon\Config;
use Phalcon\Http\Request;
use Phalcon\Logger\Adapter\File as Log;
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


    public function __construct( Facebook $fb, Config $config, Log $log )
    {
        $this->fb = $fb;
        $this->config = $config;
        $this->logger = $log;
    }

    /**
     * Generates login url, use on index page
     * 
     * @return string
     */
    public function getLoginUrl()
    {
        $perms = ['manage_pages'];
        $callback = $this->config->application->host.'/auth/callback';

        return $this->fb->getRedirectLoginHelper()
                        ->getLoginUrl($callback, $perms);
    }

    public function getAccessTokenFromCallback()
    {
        try {
            return $this->fb->getRedirectLoginHelper()
                              ->getAccessToken();
    
        } catch(\Exception $e) {
          $this->logger->error($e->getMessage());
        }
    }

    public function getUserByToken($accessToken)
    {
        $this->fb->setDefaultAccessToken($accessToken);

        try {
            return $this->fb->get('/me?fields=name,picture.type(large)')->getGraphUser();
               
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

}
