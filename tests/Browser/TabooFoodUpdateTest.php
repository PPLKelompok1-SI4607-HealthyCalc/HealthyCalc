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

            // Klik tombol edit yang ada di baris "Udang" langsung lewat JS agar lebih aman
            $browser->script("
                [...document.querySelectorAll('table tbody tr')].forEach(tr => {
                    if(tr.innerText.includes('Udang')) {
                        const btn = tr.querySelector('button[data-bs-toggle=\"modal\"]');
                        if(btn) btn.click();
                    }
                });
            ");

            // Tunggu modal spesifik muncul, contoh modal id = editTabooFoodModal-123
            // Kita coba ambil modal yang tampil dengan kelas .modal.show (modal aktif)
            $browser->waitFor('.modal.show', 5);

            // Isi form di modal yang muncul (asumsi hanya ada 1 modal aktif)
            $browser->whenAvailable('.modal.show', function (Browser $modal) {
                $modal->clear('input[name="food_name"]')
                      ->type('input[name="food_name"]', 'Keripik Ubi')
                      ->press('Simpan');
            });

            // Tunggu modal hilang setelah simpan
            $browser->waitUntilMissing('.modal.show', 5);

            // Pastikan teks baru muncul di halaman
            $browser->assertSee('Keripik Ubi');
        });
    }
}
