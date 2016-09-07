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
      $router->addPost('/login', $p . 'Index::login');

      /**
       * Admin
       */
      $router->add('/admin', $p . 'Admin::index')->via(['GET', 'POST']);
      $router->addGet('/admin/users', $p . 'Admin::getAllUsers'); // AJAX
      $router->addGet('/admin/bands', $p . 'Admin::getAllBands'); // AJAX

     /**
      * Dashboard
      */
      $router->addGet('/dashboard', $p . 'Dashboard::index');
      $router->addPost('/dashboard/update_user', $p . 'Dashboard::updateUser'); // AJAX
      $router->addGet('/dashboard/calendar', $p . 'Dashboard::rehersalsForCalendar'); // AJAX

     /**
      * Bands
      */
      $router->addGet('/bands', $p . 'Bands::index');
      $router->addGet('/bands/{pageId}', $p . 'Bands::bandDetails');
      $router->addGet('/bands/update', $p . 'Bands::updateBands'); // AJAX
      $router->addPost('/band/events', $p . 'Bands::events');      // AJAX (Facebook)
      $router->addPost('/band/tagged', $p . 'Bands::tagged');      // AJAX (Facebook)

      /**
       * Rehersals
       */
      $router->addGet('/rehersals', $p . 'Rehersals::index');
      $router->addPost('/rehersals/add', $p . 'Rehersals::add');
      $router->addPost('/rehersals/details', $p . 'Rehersals::rehersalDetails'); // AJAX

      /**
       * Venues
       */
      $router->addGet('/venues', $p . 'Venues::index');
      $router->addGet('/venues/json', $p . 'Venues::venuesJson'); // AJAX
      $router->addPost('/venues/details', $p . 'Venues::venueDetailsJson'); // AJAX (GoogleMaps)

      $router->notFound(['controller' => 'index', 'action' => 'notFound']);

        return $router;
    }
);