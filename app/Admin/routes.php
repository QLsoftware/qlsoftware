<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix' => config('admin.prefix'),
    'namespace' => Admin::controllerNamespace(),
    'middleware' => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('data/users', UserController::class);
    $router->resource('data/studentonline', Article_recordedController::class);
    $router->resource('data/jobs', jobsController::class);
    $router->resource('data/getc', getcoursesController::class);
    $router->resource('data/ch_cat', chatter_categoriesController::class);
    $router->resource('repair', repaireController::class);

});


