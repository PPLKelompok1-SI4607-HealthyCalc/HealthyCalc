<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateCommunityFailTest extends DuskTestCase
{


    /**
     * Test create and share community post.
     * @group createfail
     */
    public function testCreateAndShareCommunityPost(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com')
                ->type('password', 'testing123')
                ->press('@login-button')
                ->assertPathIs('/dashboard')
                ->visit('/communities')
                ->click('@create-post-button')
                ->waitFor('select[name="category"]', 10)
                ->select('category', 'Umum')
                ->press('Posting')
                ->pause(2000);
        });
    }
}
