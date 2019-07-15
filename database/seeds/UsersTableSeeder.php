<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Flávio Medeiros',
                'email' => 'smedeiros.flavio@gmail.com',
                'phone' => '+5519981427191',
                'password' => Hash::make('secret'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
