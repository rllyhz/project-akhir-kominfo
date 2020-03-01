<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Rully Ihza Mahendra",
            "email" => "rully@gmail.com",
            "role" => 1,
            "password" => bcrypt('password'),
        ]);
    }
}
