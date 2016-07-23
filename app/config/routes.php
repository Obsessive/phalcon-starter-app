<?php

use Phalcon\Mvc\Router;

return call_user_func(
    function() {
        
      $createDefaultRoutes = false;
      $router = new Router($createDefaultRoutes);

      // prefix
      $p = 'app\controllers\\';

      /**
       * Index
       */
      $router->addGet('/', $p . 'Index::index');
      $router->addGet('/auth/callback', $p . 'Auth::callback');
      $router->addGet('/logout', $p . 'Index::logout');

     /**
      * Dashboard
      */
      $router->addGet('/dashboard', $p . 'Dashboard::index');

     /**
      * Bands
      */
      $router->addGet('/bands', $p . 'Bands::index');
      $router->addGet('/bands/{pageId}', $p . 'Bands::bandDetails');
      $router->addGet('/bands/update', $p . 'Bands::updateBands'); // AJAX
      $router->addPost('/band/events', $p . 'Bands::events');      // AJAX

      /**
       * Rehersals
       */
      $router->addGet('/rehersals', $p . 'Rehersals::index');

      $router->notFound(['controller' => 'index', 'action' => 'notFound']);

        return $router;
    }
);