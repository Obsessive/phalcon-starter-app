<?php

namespace app\controllers;

class AppController extends ControllerBase
{
	public function onConstruct()
	{
		$this->pageRepository = $this->di->get('app.repositories.page');
	}

    public function indexAction()
    {
        $this->view->user = $this->user;
        
        $this->view->pageCount = $this->user->pages->count();
    }

    public function pagesAction()
    {
        $pages = $this->user->pages;

        if ($pages->count() == 0) {
            $this->flashSession->success($this->user->profile->first_name .", you don`t have any band pages.");
        }

        $this->view->pages = $pages;
    }

    public function pageAction($pageId)
    {
        $page = $this->user->checkPageAccess($pageId);
        if(! $page) {
            return $this->response->redirect('/app/pages');
        }

        $pageAdmins = $this->pageRepository->getPageAdmins($pageId);

        $this->view->user = $this->user;
        $this->view->page = $page;
        $this->view->admins = $pageAdmins;
    }

}
