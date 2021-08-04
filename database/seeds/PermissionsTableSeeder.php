<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

use App\Models\Module;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        $modules = Module::all();

        $operations = ['read', 'create', 'update', 'delete'];

        foreach ($modules as $module) {
            $permissions = [];
            foreach ($operations as $operation) {
                $permissions[] = [
                    'title' => $operation . '_' . $module->url,
                    'module_id' => $module->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('permissions')->insert($permissions);
        }
    }
}
