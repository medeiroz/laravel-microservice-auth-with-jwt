<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            //USERS
            [
                'name' => 'users.read',
                'display_name' => 'Users / Show',
                'created_at' => now(),
            ],
            [
                'name' => 'users.store',
                'display_name' => 'Users / Creation',
                'created_at' => now(),
            ],
            [
                'name' => 'users.update',
                'display_name' => 'Users / Update',
                'created_at' => now(),
            ],
            [
                'name' => 'users.destroy',
                'display_name' => 'Users / Delete',
                'created_at' => now(),
            ],

            [
                'name' => 'users.roles.read',
                'display_name' => 'Users / Roles / Show',
                'created_at' => now(),
            ],
            [
                'name' => 'users.roles.update',
                'display_name' => 'Users / Roles / Update',
                'created_at' => now(),
            ],


            // ROLES
            [
                'name' => 'roles.read',
                'display_name' => 'Roles / Show',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.store',
                'display_name' => 'Roles / Creation',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.update',
                'display_name' => 'Roles / Update',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.destroy',
                'display_name' => 'Roles / Delete',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.permissions.read',
                'display_name' => 'Roles / Permissions / Show',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.permissions.update',
                'display_name' => 'Roles / Permissions / Update',
                'created_at' => now(),
            ],


            // PERMISSIONS
            [
                'name' => 'permissions.read',
                'display_name' => 'Permissions / Show',
                'created_at' => now(),
            ],
            [
                'name' => 'permissions.store',
                'display_name' => 'Permissions / Creation',
                'created_at' => now(),
            ],
            [
                'name' => 'permissions.update',
                'display_name' => 'Permissions / Update',
                'created_at' => now(),
            ],
            [
                'name' => 'permissions.destroy',
                'display_name' => 'Permissions / Delete',
                'created_at' => now(),
            ],

        ]);
    }
}
