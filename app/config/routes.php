<?php

use Phalcon\Mvc\Router;

return call_user_func(
    function() {
        
        $createDefaultRoutes = false;
        $router = new Router($createDefaultRoutes);

        // prefix
        $p = 'app\controllers\\';

       $router->addGet('/', $p . 'Index::index');
       $router->addGet('/auth/callback', $p . 'Auth::callback');
       $router->addGet('/logout', $p . 'Index::logout');

       $router->addGet('/app', $p . 'App::index');
       $router->addGet('/app/pages', $p . 'App::pages');
       $router->addGet('/app/pages/update', $p . 'Page::updatePages');
       $router->addGet('/app/page/{pageId}', $p . 'Page::pageDetails');

        $router->notFound(['controller' => 'index', 'action' => 'notFound']);

        return $router;
    }
);
