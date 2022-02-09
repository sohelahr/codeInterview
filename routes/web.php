<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/key/generate', function(){
    $application_key = \Illuminate\Support\Str::random(32);
    return "Your application key is ".$application_key;
});

$router->get('/','HomeController@index');
$router->get('/view','HomeController@showViewPage');
$router->get('/import','HomeController@showImportPage');
$router->post('/import/data','HomeController@importData');

