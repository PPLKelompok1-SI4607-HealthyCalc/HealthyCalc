<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateCommunityTest extends DuskTestCase
{


    /**
     * Test create and share community post.
     * @group create-community
     */
    public function testCreateAndShareCommunityPost(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com')
                ->type('password', 'testing123')
                ->press('@login-button')

                ->pause(5000)
                ->assertPathIs('/dashboard')
                ->visit('/communities')
                ->assertSee('Diet Bro');
                // ->click('.p-0.flex-grow-1.align-self-center')
                // ->pause(2000)
                // ->select('category', 'Umum')
                // ->type('title', 'Diet Bro')
                // ->type('description', 'DIET itu penting untuk kesehatan tubuh')
                // ->press('Posting')
                // ->pause(2000);
        });
    }
}
