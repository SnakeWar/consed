<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'Maxmeio',
            'email' => 'maxmeio@maxmeio.com',
            'password' => bcrypt('1q2w3e4r'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}