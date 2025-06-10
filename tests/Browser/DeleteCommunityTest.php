<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteCommunityTest extends DuskTestCase
{
    /**
     * Test deleting a community post.
     * @group delete-community
     */
    public function testDeleteCommunityPost(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com')
                ->type('password', 'testing123')
                ->press('@login-button')
                ->waitForLocation('/dashboard', 10)
                ->assertPathIs('/dashboard')

                ->visit('/communities/1')

                ->visit('/communities/10')

                ->click('.bi-trash') 
                ->waitForLocation('/communities', 10)
                ->assertPathIs('/communities')
                ->assertDontSee('Diet Bro');
        });
    }

}


