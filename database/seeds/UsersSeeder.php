<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@gmail.com',
            'password' => '$2a$12$tfOtjl6T3/MG7T31ouHRMerrwBfYPVlgIQf1cpHMiu9MZnYF6kRMK',
            'phone' => '0123456789',
            'name' => 'Admin',
            'gender' => 'Nam',
            'birthday' => '2000/05/11',
            'address' => 'Hà Nội',
            'department_id' => 1,
            'role_id' => 1,
            'is_admin' => 1,
            'first_login' => 0,
            ]);
    }
}
