<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $this->setupAccountsRole();
    }

    public function setupAccountsRole()
    {
        // Define permissions
        $permissions = [
            'view dashboard' => 'accountsadmin',
            'manage accounting' => 'accountsadmin',
            'manage account-manager' => 'accountsadmin',
            'manage reporting' => 'accountsadmin',
            'manage vendors' => 'accountsadmin',
            'view compliance' => 'accountsadmin',
            'manage compliance' => 'accountsadmin',
        ];

        // Create or Update Permissions
        foreach ($permissions as $name => $guardName) {
            $permission = Permission::where('name', $name)->where('guard_name', $guardName)->first();
            if (!$permission) {
                Permission::create(['name' => $name, 'guard_name' => $guardName]);
            }
        }

        // Define roles and their permissions
        $roles = [
            'Accounts Manager' => [
                'view dashboard',
                'manage accounting',
                'manage account-manager',
                'manage reporting',
                'manage vendors',
                'view compliance',
                'manage compliance'
            ],
            'Compliance' => [
                'view dashboard',
                'view compliance',
                'manage compliance'
            ],
            'Accounts Payable' => [
                'manage vendors',
                'view dashboard'
            ],
            'Accounts Receivable' => [
                'manage accounting',
                'view dashboard'
            ],
            'MIS Reporting' => [
                'view dashboard',
                'manage reporting',
                'manage account-manager'
            ]
        ];

        // Create or Update Roles and Assign Permissions
        foreach ($roles as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->where('guard_name', 'accountsadmin')->first();
            if (!$role) {
                $role = Role::create(['name' => $roleName, 'guard_name' => 'accountsadmin']);
            }
            $role->syncPermissions($permissions);
        }
    }
}

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

// class RolePermissionSeeder extends Seeder
// {
//     public function run()
//     {
//         $this->setupAccountsRole();
//     }
//     public function setupAccountsRole(){
//         // Create Permissions
//         Permission::create(['name' => 'view dashboard']);
//         Permission::create(['name' => 'manage accounting']);
//         Permission::create(['name' => 'manage account-manager']);
//         Permission::create(['name' => 'manage reporting']);
//         Permission::create(['name' => 'manage vendors']);
//         Permission::create(['name' => 'view compliance']);
//         Permission::create(['name' => 'manage compliance']);
        
//         // Create Roles and Assign Permissions
//         Role::create(['name' => 'Accounts Manager', 'guard_name' => 'accountsadmin']);
//         Role::create(['name' => 'Compliance', 'guard_name' => 'accountsadmin']);
//         Role::create(['name' => 'Accounts Payable', 'guard_name' => 'accountsadmin']);
//         Role::create(['name' => 'Accounts Receivable', 'guard_name' => 'accountsadmin']);
//         Role::create(['name' => 'MIS Reporting', 'guard_name' => 'accountsadmin']);
//         $accountsManager = Role::create(['name' => 'Accounts Manager','guard_name' => 'accountsadmin']);
//         $accountsManager->givePermissionTo([
//             'view dashboard',
//             'manage accounting',
//             'manage account-manager',
//             'manage reporting',
//             'manage vendors',
//             'view compliance',
//             'manage compliance'
//         ]);

//         $compliance = Role::create(['name' => 'Compliance','guard_name' => 'accountsadmin']);
//         $compliance->givePermissionTo([
//             'view dashboard',
//             'view compliance',
//             'manage compliance'
//         ]);

//         $accountsPayable = Role::create(['name' => 'Accounts Payable','guard_name' => 'accountsadmin']);
//         $accountsPayable->givePermissionTo([
//             'manage vendors',
//             'view dashboard',
//         ]);

//         $accountsReceivable = Role::create(['name' => 'Accounts Receivable','guard_name' => 'accountsadmin']);
//         $accountsReceivable->givePermissionTo(
//             [
//             'manage accounting',
//             'view dashboard',
//             ]
//         );

//         $misReporting = Role::create(['name' => 'MIS Reporting','guard_name' => 'accountsadmin']);
//         $misReporting->givePermissionTo([
//             'view dashboard',
//             'manage reporting',
//             'manage account-manager'
//         ]);
//     }
// } 
