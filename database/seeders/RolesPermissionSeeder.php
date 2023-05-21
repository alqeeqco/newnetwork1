<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = DB::table('permissions')->get();

        $role = Role::create([
            'name' => 'super-admin',
            'guard_name' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ( $permissions as $permission) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission->id,
                'role_id' => $role->id,
            ]);
        }

        DB::table('model_has_roles')->insert([
            'model_type' => 'App\Models\Admins',
            'model_id' => 1,
            'role_id' => $role->id,
        ]);
    }
}
