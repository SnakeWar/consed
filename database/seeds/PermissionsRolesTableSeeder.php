<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

use App\Models\Permission;

class PermissionsRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();
        $permission_roles = [];
        foreach ($permissions as $permission) {
            $permission_roles[] = [
                'role_id' => 1,
                'permission_id' => $permission->id
            ];
        }

        DB::table('permission_role')->insert($permission_roles);
    }
}
