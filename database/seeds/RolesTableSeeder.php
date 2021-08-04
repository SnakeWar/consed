<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'title' => 'Administrador',
            'description' => 'Administrador geral',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
