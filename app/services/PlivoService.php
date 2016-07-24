<?php

namespace app\services;

use Plivo\RestAPI;
use app\models\Rehersals;
use app\repositories\UserRepository;
use app\repositories\PageRepository;
use Phalcon\Logger\Adapter\File as FileAdapter;


/**
 * PlivoService communicates with Plivo API
 * 
 */
class PlivoService {

    /**
     * @var Plivo\RestAPI
     */
    protected $plivo;

    /**
     * @var app\repositories\PageRepository
     */
    protected $pageRepository;

    /**
     * @var app\repositories\UserService
     */
    protected $userService;

    /**
     * @var Phalcon\Logger\Adapter\File
     */
    protected $plivoLogger;

    public function __construct( RestAPI $plivo, PageRepository $pr, UserService $us, FileAdapter $log )
    {
        $this->plivo = $plivo;
        $this->pageRepository = $pr;
        $this->userService = $us;
        $this->plivoLogger = $log;
    }

    /**
     * Send new SMS rehersal notification to all page admins
     * 
     * @var Rehersals $rehersal
     * @return void
     */
    public function sendRehersalSms(Rehersals $rehersal)
    {
        $admins = $this->pageRepository->getPageAdmins($rehersal->page_id);
        $currentUser = $this->userService->getCurrentUser();

        foreach ($admins as $user) {
            if ($user->profile->number) {  /* && ($user->id != $currentUser->id) ADD THIS FOR PRODUCTION !!!! */
                
                $msg = $currentUser->name . " je rezervirao/la probu za bend: " . $rehersal->page->name . " - Datum i vrijeme: " . $rehersal->scheduled_at . " - Napomena: " . $rehersal->note;

                $this->sendSms($user->profile->number, $msg);
            }
        }
    }

    /**
     * Send Plivo SMS message with text to destination number
     * 
     * @param string $dst
     * @param string $text
     * @throws Exception $e
     * @return void
     */
    public function sendSms($dst, $text)
    {
        $params = array(
            'src' => '1111111111',
            'dst' => $dst,
            'text' => $text
        );

        try {
//            $response = $this->plivo->send_message($params);  // Uncomment for production
        } catch (Exception $e) {
            $this->plivoLogger->error(json_encode($e->getMessages()));
            return;
        }

        $success = [ 'destination' => $dst, 'text' => utf8_decode($text) ];

        $this->plivoLogger->info(json_encode($success));
    }

}