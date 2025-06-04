<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TabooFoodUpdateTest extends DuskTestCase
{
    /**
     * Test user can update taboo food successfully.
     *
     * @group tabooupdate
     * @return void
     */
    public function test_user_can_update_taboo_food_successfully()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'tepi2@gmail.com')
                ->type('password', '12345678')
                ->press('Sign In')
                ->assertSee('Dashboard')
                ->pause(1000)
                ->visit('/taboo-foods')
                ->assertSee('Daftar Makanan Pantangan')
                ->pause(1000);

            // Cari container makanan dengan data-food-name 'udang' lalu klik tombol edit
            $browser->with("[data-food-name='udang']", function ($food) {
                $food->click('button.btn-outline-primary');
            });

            // Tunggu modal edit muncul
            $browser->waitFor('.modal.show', 5);

            // Isi form modal yang aktif
            $browser->whenAvailable('.modal.show', function ($modal) {
                $modal->clear('input[name="food_name"]')
                      ->type('input[name="food_name"]', 'Keripik Ubi')
                      ->select('select[name="taboo"]', 'kolesterol')
                      ->press('Ubah');
            });

            // Tunggu modal hilang
            $browser->waitUntilMissing('.modal.show', 5);

            // Pastikan perubahan tampil di halaman
            $browser->assertSee('Keripik Ubi')
                    ->assertSee('kolesterol');
        });
    }
}
