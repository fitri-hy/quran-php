<?php
use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\ErrorController;

Router::get('/', 'HomeController@index');
Router::get('/surah/:id', 'HomeController@detail');
Router::get('/error', 'ErrorController@show');