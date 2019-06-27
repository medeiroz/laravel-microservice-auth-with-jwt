<?php

use Illuminate\Database\Seeder;
use App\Models\Auth\User;
use App\Models\Auth\Role;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $me = User::byEmail('smedeiros.flavio@gmail.com')->first();
        $role_admin = Role::byName('admin');

        DB::table('role_user')->insert([
            [
                'role_id' => $me->id,
                'user_id' => $role_admin->id,
            ],
        ]);
    }
}
