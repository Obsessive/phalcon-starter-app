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

        $router->notFound(['controller' => 'index', 'action' => 'notFound']);

        return $router;
    }
);
