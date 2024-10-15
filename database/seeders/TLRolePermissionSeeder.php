<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TLRolePermissionSeeder extends Seeder
{
     /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Define permissions for teamlead
        $permissions = ['view', 'edit', 'delete', 'create'];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
