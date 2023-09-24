<?php 
namespace App\Controllers;

use App\Models\UserModel;
use App\Core\Controller;
use App\Core\View;
use Monolog\Logger;

class HomeController extends Controller{
    protected View $view;
    protected UserModel $userModel;

    public function __construct(View $view, Logger $logger)
    {
        parent::__construct();
        $this->userModel = new UserModel($logger);
        $this->view = $view;
    }

    public function index(): void
    {
		echo $this->view->render('index.twig');
	}
}