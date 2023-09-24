<?php

namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
    public function example(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM phinxlog");
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e){
            $this->logger->critical($e->getMessage());
        }

        return $result;
    }
}