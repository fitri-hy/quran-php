<?php
use Core\Router;
use App\Controllers\Api\WelcomeController;

Router::get('/v1', 'WelcomeController@index');