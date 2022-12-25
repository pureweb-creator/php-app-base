<?php 
namespace App\Controllers;

use App\Core\Controller;

class AboutController extends Controller{
	public function index(){

		$this->data->title =  $this->lang->aboutpage_title;
		
		$this->view->render('about', $this->data);
	}
}