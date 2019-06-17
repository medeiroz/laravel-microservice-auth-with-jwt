<?php

use Illuminate\Database\Seeder;
use \App\Models\Auth\Role;
use \App\Models\Auth\Permission;


class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::get();

        $admin = Role::byName('admin');

        $admin->perms()->sync($permissions);

    }
}
