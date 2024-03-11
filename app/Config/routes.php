<?php

use App\Core\Router;
use App\Controllers\HomeController;

Router::get('/home', [HomeController::class, 'index']);
Router::get('/directory-iterator', [HomeController::class, 'directoryIterator']);
Router::post('/directory-iterator', [HomeController::class, 'directoryIteratorForm']);
Router::post('/test2', function (){
    echo 'hi';
});
