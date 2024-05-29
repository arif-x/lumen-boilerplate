<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role' => [
                'role-index',
                'role-store',
                'role-update',
                'role-destroy',
            ],
            'user' => [
                'user-index',
                'user-store',
                'user-update',
                'user-destroy',
            ],
            'contact' => [
                'contact-index',
                'contact-store',
                'contact-update',
                'contact-destroy',
            ]
        ];

        foreach ($permissions as $k => $v) {
            foreach ($v as $key => $value) {
                $arr = [];
                $arr['name'] = $value;
                $arr['guard_name'] = 'api';
                Permission::create($arr);
            }
        }

        $superadmin = Role::where('name', 'Superadmin')->first()->givePermissionTo([
            $permissions
        ]);

        $admin = Role::where('name', 'Admin')->first()->givePermissionTo([
            $permissions['contact']
        ]);

        $user = Role::where('name', 'User')->first()->givePermissionTo([
            $permissions['contact']
        ]);
    }
}
