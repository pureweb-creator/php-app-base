<?php

namespace App\Core;

/**
 * Model
 */
abstract class Model
{
	protected \PDO $pdo;
    public function __construct()
	{
        try {
	        $this->pdo = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USERNAME,DB_PASSWORD);
        } catch (\Exception $e){
        }
	}
}