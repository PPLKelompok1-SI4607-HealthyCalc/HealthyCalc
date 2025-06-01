<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TabooFoodViewNoDataTest extends DuskTestCase
{
    /**
     * @group tabooviewnodata
     */
    public function testUserSeesNoDataMessage_WhenNoTabooFoodExists()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'tepi2@gmail.com')
                    ->type('password', '12345678')
                    ->press('Sign In')
                    ->assertSee('Dashboard')
                    ->pause(1000)
                    ->visit('/taboo-foods')
                    ->pause(1000)
                    ->assertSee('Belum ada daftar makanan pantangan.');
        });
    }
}
