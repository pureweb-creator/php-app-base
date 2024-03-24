<?php

use App\Core\Router;
use App\Controllers\HomeController;

Router::get('/home', [HomeController::class, 'index']);
