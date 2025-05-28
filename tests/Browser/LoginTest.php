<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{

    public function test_user_can_login_with_valid_credentials()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->assertPathIs('/login')
                ->waitForText('Sign In', 5)                     // tunggu teks utama muncul
                ->waitFor('@email', 5)                          // tunggu input email muncul
                ->type('@email', 'user1@gmail.com')
                ->type('@password', '123456789')
                ->press('@login-button')
                ->waitForLocation('/dashboard')
                ->assertPathIs('/dashboard')
                ->assertSee('Dashboard')
                ->screenshot('login-success');
        });
    }
}
