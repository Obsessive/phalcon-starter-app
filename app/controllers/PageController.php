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
    		return $this->response->redirect('/app/pages');
    	}

    	return $this->response->redirect('/');
    }

    public function pageDetailsAction($pageId)
    {
        $page = $this->user->checkPageAccess($pageId);
        if(! $page) {
            return $this->response->redirect('/app/pages');
        }

        $pageDetails = $this->facebookService->getPageDetails($page);

        
    }
}
