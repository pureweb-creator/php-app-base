<?php 
namespace App\Controllers;

use App\Core\Controller;

class ContactsController extends Controller{
	public function index(){

		$this->data->title = $this->lang->contactspage_title;
		
		$this->view->render('contacts', $this->data);
	}
}