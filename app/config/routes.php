<?php

use Phalcon\Mvc\Router;

return call_user_func(
    function() {
        
        $createDefaultRoutes = false;
        $router = new Router($createDefaultRoutes);

        // prefix
        $p = 'app\controllers\\';

       $router->add('/', $p . 'Index::index')->via(['GET', 'POST']);
       $router->add('/test', $p . 'Index::test')->via(['GET', 'POST']);

        $router->notFound(['controller' => 'index', 'action' => 'notFound']);

        return $router;
    }
);
