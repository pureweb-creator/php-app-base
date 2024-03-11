<?php

namespace App\Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/**
 * View
 */
class View
{
    private $loader;
    private $twig;

    public function render($page, $data=[])
    {
        $this->loader = new FilesystemLoader('static/view');
        $this->twig = new Environment($this->loader,['debug'=>true]);
        $this->twig->addGlobal('session', $_SESSION);
//        $this->twig->addGlobal('home_url', Router::getUrl());

        try {
            $tpl = $this->twig->load($page);
            return $tpl->render($data);
        } catch (\Twig\Error\LoaderError | \Twig\Error\RuntimeError | \Twig\Error\SyntaxError $e){
            http_response_code(500);
            die();
        }
	}
}