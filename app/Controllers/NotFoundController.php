<?php

namespace App\Controllers;

use App\Core\View;
use Monolog\Logger;

class NotFoundController extends \App\Core\Controller
{
    public function __construct(protected View $view)
    {
        parent::__construct();
    }

    public function index(): void
    {
        echo $this->view->render('404.twig');
    }
}