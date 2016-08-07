<?php

namespace app\controllers;

use app\models\Rehersals;

class RehersalsController extends ControllerBase
{
	public function onConstruct()
	{
		$this->rehersalsRepository = $this->di->get('app.repositories.rehersals');
		$this->plivoService = $this->di->get('app.services.plivo');
	}

    public function indexAction()
    {
    	$this->view->user = $this->user;
    	$this->view->bands = $this->user->pages;
    }

    /**
     * Add rehersal, used in AJAX request
     */
    public function addAction()
    {
        if ($this->request->isPost()) {

            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            
            $rehersal = new Rehersals();

            $rehersal->page_id = $request->band_id;
            $rehersal->location = $request->location;
            $rehersal->scheduled_at = $request->date_time;
            $rehersal->note = $request->note;

            if (! $this->rehersalsRepository->check($rehersal)) {
            	echo $this->jsonResponse('You already reserved rehersal for given date/time and band.', 0);
            	return;
            }

            $rehersal->save();
            $this->flashSession->success('New rehersal created for ' . $rehersal->page->name);

            $this->plivoService->sendRehersalSms($rehersal);
        }
    }

    /**
     * Get single rehersal details
     * Used in AJAX request
     */
    public function rehersalDetailsAction()
    {
        if ($this->request->isPost()) {

            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);

            $rehersal_id = $request->rehersal_id;            
            $rehersal = $this->rehersalsRepository->findFirstBy([ 'id' => $request->rehersal_id ]);

            if ($rehersal) {
                
                $result = [
                    'rehersal'  => $rehersal->toArray(),
                    'band'      => $rehersal->page->toArray()
                ];

                echo $this->jsonResponse($result);
                return;
            }

            echo $this->jsonResponse('No rehersal found', 0);
        }
    }

}

