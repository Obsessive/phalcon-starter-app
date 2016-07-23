<?php

namespace app\controllers;

class BandsController extends ControllerBase
{
	public function onConstruct()
	{
		$this->facebookService = $this->di->get('app.services.facebook');
		$this->pageRepository = $this->di->get('app.repositories.page');
	}

    /**
     * Showing table with all bands for user
     */
    public function indexAction()
    {
        $pages = $this->user->pages;

        if ($pages->count() == 0) {
            $this->flashSession->success($this->user->profile->first_name .", you don`t have any band pages.");
        }

        $this->view->pages = $pages;
    }

    /**
     * Show single band page details
     * 
     * @param $pageId
     */
    public function bandDetailsAction($pageId)
    {
        $page = $this->user->checkPageAccess($pageId);
        if(! $page) {
            return $this->response->redirect('/bands');
        }

        $pageAdmins = $this->pageRepository->getPageAdmins($pageId);

        $this->view->user = $this->user;
        $this->view->page = $page;
        $this->view->admins = $pageAdmins;
    }



    /**
     * Update pages data for given Facebook pages and user
     */
    public function updateBandsAction()
    {
    	$pageNodes = $this->facebookService->getUserPages();

    	if( $this->pageRepository->updatePagesForUser($pageNodes, $this->user->id) ) {

            foreach ($this->user->pages as $page) {
                $graphPage = $this->facebookService->getPageData($page->facebook_page_id);
                $this->pageRepository->updatePageProfile($page->id, $graphPage);
            }

            $this->flashSession->success($this->user->profile->first_name .", your bands are updated.");
    		return $this->response->redirect('/dashboard');
    	}

    	return $this->response->redirect('/');
    }

    public function eventsAction()
    { 
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $pageId = $request->pageId;

        $page = $this->user->checkPageAccess($pageId);
        if(! $page) {
            return null;
        }

        $events = $this->facebookService->getPageEvents($page->facebook_page_id);

        if ($events) {
            echo json_encode($events->asArray());
        }
    }

}