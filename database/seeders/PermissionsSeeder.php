<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        $permissionsList = [

            'roles show',
            'roles create',
            'roles edit',
            'roles delete',

            'managers show',
            'managers create',
            'managers edit',
            'managers delete',

            'coaches show',
            'coaches create',
            'coaches edit',
            'coaches delete',

            'students show',
            'students create',
            'students edit',
            'students delete',

            'levels show',
            'levels create',
            'levels edit',
            'levels delete',

            'lessons show',
            'lessons create',
            'lessons edit',
            'lessons delete',

            'horses show',
            'horses create',
            'horses edit',
            'horses delete',

            'posts show',
            'posts create',
            'posts edit',
            'posts delete',

            'pages show',
            'pages create',
            'pages edit',
            'pages delete',

            'reports show',
            'reports print',

            'contacts show',
            'contacts delete',

            'settings show',

        ];
        $roles = [
            'Admin' => $permissionsList,
            'Coach' => [],
            'Student' => [],

        ];

        foreach ($roles as $role => $permissions) {
            $Role = Role::findOrCreate($role);
            foreach ($permissions as $permission) {
                Permission::findOrCreate($permission);
                $Role->syncPermissions(Permission::whereIn('name', $permissions)->get());
            }
        }
    }
}
