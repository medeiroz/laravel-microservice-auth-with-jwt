<?php

namespace Tests\Unit;

use App\Models\Auth\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFirstName()
    {
        $user = new User();
        $user->fill([
            'id' => 1,
            'name' => 'Flávio Medeiros',
            'email' => 'smedeiros.flavio@gmail.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $this->assertEquals($user->first_name, "Flávio");
    }


}
