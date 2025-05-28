<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_can_register_successfully(): void
    {
        // Buat data unik untuk menghindari duplikasi
        $name = 'Test User';
        $username = 'testuser_' . Str::random(5);
        $email = 'test_' . Str::random(5) . '@example.com';
        $password = 'password123';

        $this->browse(function (Browser $browser) use ($name, $username, $email, $password) {
            $browser->visit('http://127.0.0.1:8000/register')
                ->type('name', $name)
                ->type('username', $username)
                ->type('email', $email)
                ->type('password', $password)
                ->press('Create account')
                ->assertPathIs('/login') 
                ->screenshot('Register Success'); 

        });
    }
}
