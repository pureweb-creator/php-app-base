<?php 
namespace App\Controllers;

use App\Models\UserModel;
use App\Core\Controller;
use App\Core\View;
use App\Services\Service;
use Monolog\Logger;

class HomeController extends Controller{
    public function index(UserModel $user, Service $service): void
    {
        $this->data['user'] = $user->example();
        echo $service->greetingTo('roman');

		echo $this->view->render('index.twig', $this->data);
        unset($_SESSION['error']);
	}
}