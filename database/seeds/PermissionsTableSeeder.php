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
                'display_name' => 'Usuarios / Visualização',
                'created_at' => now(),
            ],
            [
                'name' => 'users.store',
                'display_name' => 'Usuarios / Criação',
                'created_at' => now(),
            ],
            [
                'name' => 'users.update',
                'display_name' => 'Usuarios / Atualização',
                'created_at' => now(),
            ],
            [
                'name' => 'users.destroy',
                'display_name' => 'Usuarios / Exclusão',
                'created_at' => now(),
            ],
            [
                'name' => 'users.roles.read',
                'display_name' => 'Usuários / Papéis / Visualização',
                'created_at' => now(),
            ],
            [
                'name' => 'users.roles.store',
                'display_name' => 'Usuários / Papéis / Criação',
                'created_at' => now(),
            ],
            [
                'name' => 'users.roles.update',
                'display_name' => 'Usuários / Papéis / Atualização',
                'created_at' => now(),
            ],
            [
                'name' => 'users.roles.destroy',
                'display_name' => 'Usuários / Papéis / Exclusão',
                'created_at' => now(),
            ],


            // ROLES
            [
                'name' => 'roles.read',
                'display_name' => 'Papéis / Visualização',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.store',
                'display_name' => 'Papéis / Criação',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.update',
                'display_name' => 'Papéis / Atualização',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.destroy',
                'display_name' => 'Papéis / Exclusão',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.permissions.read',
                'display_name' => 'Papéis / Permissões / Visualização',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.permissions.store',
                'display_name' => 'Papéis / Permissões / Criação',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.permissions.update',
                'display_name' => 'Papéis / Permissões / Atualização',
                'created_at' => now(),
            ],
            [
                'name' => 'roles.permissions.destroy',
                'display_name' => 'Papéis / Permissões / Exclusão',
                'created_at' => now(),
            ],


            // PERMISSIONS
            [
                'name' => 'permissions.read',
                'display_name' => 'Permissões / Visualização',
                'created_at' => now(),
            ],
            [
                'name' => 'permissions.store',
                'display_name' => 'Permissões / Criação',
                'created_at' => now(),
            ],
            [
                'name' => 'permissions.update',
                'display_name' => 'Permissões / Atualização',
                'created_at' => now(),
            ],
            [
                'name' => 'permissions.destroy',
                'display_name' => 'Permissões / Exclusão',
                'created_at' => now(),
            ],
        ]);
    }
}
