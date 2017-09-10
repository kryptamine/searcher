<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

$router->post('/search', 'SearcherController@search');
$router->get('/results', 'SearcherController@index');
$router->get('/results/:id', 'SearcherController@show');
