<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginFailureTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_user_cannot_login_with_invalid_credentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                    ->type('email', 'invalid@example.com')   // Email tidak terdaftar
                    ->type('password', 'wrongpassword')      // Password salah
                    ->press('@login-button')
                    ->assertPathIs('/login')
                    ->screenshot('login-failure');             
        });
    }
}
