<?php

namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
    public function example(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM phinxlog");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}