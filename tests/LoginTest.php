<?php

use App\User;

class LoginTest extends TestCase
{
    function test_a_user_can_login()
    {
        // Having
        User::create([
                'name' => 'Jane Doe',
                'email' => 'jdoe@gmail.com',
                'password'  => bcrypt('secret')
            ]);
        // Acting
        $this->visit('/login')
            ->seePageIs('/login')
            ->type('jdoe@gmail.com', 'email')
            ->type('secret','password')
            ->press('Login');
        // Then
        $this->seePageIs('/home')
            ->see('Seleccione la facultad:');
    }
/** TODO with Laravel Dusk
    function test_a_user_can_logout()
    {
        // Having
        $user = User::create([
                'name' => 'Jane Doe',
                'email' => 'jdoe@gmail.com',
                'password'  => bcrypt('secret')
            ]);
        // Acting
        $this->visit('/login')
            ->seePageIs('/login')
            ->type('jdoe@gmail.com', 'email')
            ->type('secret','password')
            ->press('Login');
        // Then
        $this->seePageIs('/home')
            ->see($user->name)
            ->click($user->name)
            ->select('Logout');
    }
*/
}
