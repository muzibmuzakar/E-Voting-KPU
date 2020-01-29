<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});

Route::group(['middleware' => ['auth']], function ($router) {
    // calon
    $router->post('/calon', 'CalonController@store');
    $router->put('/calon/{id}', 'CalonController@update');
    $router->delete('/calon/{id}', 'CalonController@destroy');

    // tps
    $router->post('/tps', 'TpsController@store');
    $router->put('/tps/{id}', 'TpsController@update');
    $router->delete('/tps/{id}', 'TpsController@destroy');

    // voter
    $router->post('/voter', 'VoterController@store');
    $router->put('/voter/{id}', 'VoterController@update');
    $router->delete('/voter/{id}', 'VoterController@destroy');

    // vote
    $router->delete('/vote/{id}', 'VoteController@destroy');
    $router->put('/vote/{id}', 'VoteController@update');
});

// calon
$router->get('/calon', 'CalonController@index');
$router->get('/calon/{id}', 'CalonController@show');

// tps
$router->get('/tps', 'TpsController@index');
$router->get('/tps/{id}', 'TpsController@show');

// voter
$router->get('/voter', 'VoterController@index');
$router->get('/voter/{id}', 'VoterController@show');

// vote
$router->get('/vote', 'VoteController@index');
$router->get('/vote/{id}', 'VoteController@show');
$router->post('/vote', 'VoteController@store');

// hasil
$router->get('/hasil', 'HasilController@index');
