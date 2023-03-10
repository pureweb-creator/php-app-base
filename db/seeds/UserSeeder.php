<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i<10; $i++){
            $data[] = [
                'name' => $faker->userName,
                'email' => $faker->email(),
                'password' => password_hash($faker->password(), PASSWORD_DEFAULT)
            ];
        }

        $this->table('user')
            ->insert($data)
            ->save();
    }
}
