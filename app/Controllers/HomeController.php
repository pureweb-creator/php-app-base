<?php 
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use Monolog\Logger;

class HomeController extends Controller{
    protected View $view;

    public function __construct(View $view, Logger $logger)
    {
        parent::__construct();

        $this->view = $view;
    }

    public function index(): void
    {
        $this->data = [
            'title'=>'PHP App Base'
        ];

		echo $this->view->render('index.twig', $this->data);
	}
}