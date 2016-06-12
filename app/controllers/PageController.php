<?php

namespace app\controllers;

class PageController extends ControllerBase
{
	public function onConstruct()
	{
		$this->facebookService = $this->di->get('app.services.facebook');
		$this->pageRepository = $this->di->get('app.repositories.page');
	}

    /**
     * Update pages data for given Facebook pages and user
     */
    public function updatePagesAction()
    {
    	$pageNodes = $this->facebookService->getUserPages();

    	if( $this->pageRepository->updatePagesForUser($pageNodes, $this->user->id) ) {

            foreach ($this->user->pages as $page) {
                $graphPage = $this->facebookService->getPageData($page->facebook_page_id);
                $this->pageRepository->updatePageProfile($page->id, $graphPage);
            }

            $this->flashSession->success($this->user->profile->first_name .", your bands are updated.");
    		return $this->response->redirect('/app');
    	}

    	return $this->response->redirect('/');
    }

    public function eventsAction()
    {
        $pageId = $this->request->get('pageId');

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