<?php

namespace App\Core;

/**
 * Controller
 */
abstract class Controller
{
	protected array $data;

	public function __construct()
    {
        $lang = match(@$_GET['lang']){
            'en'=>'en',
            default=>'ua'
        };

        $this->data['lang'] = Helper::getLanguage($lang);

        unset($_SESSION["response"]);
    }
}