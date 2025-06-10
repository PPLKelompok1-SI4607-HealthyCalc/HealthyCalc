<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditCommunityTest extends DuskTestCase
{
    /**
     * Test editing a community post.
     * @group edit-community
     */
    public function testEditCommunityPost(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com')
                ->type('password', 'testing123')
                ->pause(2000) 
                ->press('@login-button')
                ->assertPathIs('/dashboard')

        ->visit('/communities/11')
                ->click('.bi.bi-pencil-square')
                ->pause(2000)
                ->waitFor('form[action*="/communities/11"]', 10)
                ->type('title', 'Diet tapi males')
                ->type('description', 'DIET itu penting untuk kesehatan tubuh')
                ->select('category', 'Umum')
                ->press('Ubah')
                ->assertSee('Diet tapi males');
        });
    }
}

