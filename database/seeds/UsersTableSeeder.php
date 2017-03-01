<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Tùng Pro',
            'email' => 'mr.nttung@gmail.com',
            'password' => bcrypt('123456'),
            'active' => true,
        ]);
    }
}
