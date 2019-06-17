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
            [
                'name' => 'users_index',
                'display_name' => 'Usuarios - Listagem',
                'description' => 'Listagem dos usuários',
                'created_at' => now(),
            ],
            [
                'name' => 'users_show',
                'display_name' => 'Usuarios - Visualização',
                'description' => 'Visualização das informações do usuário',
                'created_at' => now(),
            ],
            [
                'name' => 'users_store',
                'display_name' => 'Usuarios - Criação',
                'description' => 'Criação de um novo Usuário',
                'created_at' => now(),
            ],
            [
                'name' => 'users_update',
                'display_name' => 'Usuarios - Atualização',
                'description' => 'Atualização de um Usuário existente',
                'created_at' => now(),
            ],
        ]);
    }
}
