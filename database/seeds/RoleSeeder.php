<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $roles = [
            'Admin', 'User',
        ];

        for ($i = 0; $i < count($roles); $i++) {
            Role::create([
                'nama_role' => $roles[$i],
            ]);
        }
    }
}
