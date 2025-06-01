<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TabooFoodViewTest extends DuskTestCase
{
    /**
     * @group tabooview
     */
    public function testUserCanSeeTabooFoodList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'tepi2@gmail.com')      // Ganti dengan akun login kamu
                ->type('password', '12345678')          // Ganti juga password-nya
                ->press('Sign In')
                ->assertSee('Dashboard')
                ->pause(1000)

                ->visit('/taboo-foods')
                ->pause(1000)

                // Pastikan tombol sudah muncul
                ->waitForText('+ Tambah Makanan Pantangan', 5)
                ->pause(500);

            // Klik tombol menggunakan JavaScript (karena bukan <button>)
            $browser->script("document.querySelector('p.bg-success.text-white.rounded-3').click();");

            $browser->pause(1000)

                // Isi form tambah makanan pantangan
                ->select('taboo', 'alergi')
                ->type('food_name', 'Udang')
                ->press('Tambah')
                ->pause(2000)

                ->visit('/taboo-foods')
                ->pause(1000)
                ->assertSee('Udang');
        });
    }
}
