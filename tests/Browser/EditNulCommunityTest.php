<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditNulCommunityTest extends DuskTestCase
{
    /**
     * Test editing a community post.
     * @group editnul
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
                ->visit('/communities/1')
                ->click('.bi-pencil-square')
                ->pause(2000)
                ->waitFor('form[action*="/communities/1"]', 10)
                ->type('title', 'Diet Bro')
                ->type('description', 'DIET itu penting untuk kesehatan tubuh')
                ->press('Ubah')
                ->assertSee('Konten tidak boleh kosong.');
        });
    }
}
