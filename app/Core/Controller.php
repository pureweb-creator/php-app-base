<?php

namespace App\Core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Controller
 */
abstract class Controller
{
    protected ?Logger $logger;
	protected ?View $view;
	protected $model;
	protected object $data;
	protected object $lang;

	public function __construct()
	{
        // set logging
        $this->logger = new Logger('controller');
        $this->logger->pushHandler(new StreamHandler('debug.log'));

        $availableLanguages = ['ru', 'en'];
		$defaultLanguage = $availableLanguages[0];

		// middleware
		if (!in_array(Router::getCurrentLang(), $availableLanguages))
			header("Location: ".SITEURL."/$defaultLanguage");

        // load language file
		$this->lang = (object) include $_SERVER['DOCUMENT_ROOT']."/tpl/lang/".Router::getCurrentLang().".php";

        // Prepare the data view
		$this->data = (object) array(
			'active' => Router::getCurrentController(),
			'home_url' => Router::getUrl(),
			'lang_code' => Router::getCurrentLang(),
			'lang' => $this->lang,
			'lang_list' => $availableLanguages
		);
		$this->view = new View();
	}

	protected function csrf_check(): void
    {
		if (!isset($_POST['csrf'])){
			die("No CSRF token provided");
		}
		if ($_POST['csrf'] != $_SESSION['csrf_token']){
			die("CSRF token mismatch");
		}

		unset($_SESSION['csrf_token']);
	}
}