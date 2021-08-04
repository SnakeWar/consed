<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('modules')->delete();

        DB::table('modules')->insert([
            [
                'title' => 'Usuários',
                'url' => 'users',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Grupos',
                'url' => 'roles',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Newsletters',
                'url' => 'newsletters',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Modulos',
                'url' => 'modules',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Posts',
                'url' => 'posts',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Categorias',
                'url' => 'categories',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Vídeos',
                'url' => 'videos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Banners',
                'url' => 'banners',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
