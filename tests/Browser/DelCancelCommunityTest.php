<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DelCancelCommunityTest extends DuskTestCase
{
    /**
     * Test cannot delete community post not owned by user.
     * @group delcancel
     */
    public function testCannotDeleteOtherUserCommunityPost(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser1@example.com')
                ->type('password', 'testing123')
                ->press('@login-button')
                ->waitForLocation('/dashboard', 10)
                ->assertPathIs('/dashboard')
                ->visit('/communities/3')
                ->assertDontSee('bi-trash');
        });
    }
}
