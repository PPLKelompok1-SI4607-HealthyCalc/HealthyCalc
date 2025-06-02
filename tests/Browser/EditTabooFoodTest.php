<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\DB;

class EditTabooFoodTest extends DuskTestCase
{
    /**
     * Test user can update taboo food successfully.
     *
     * @group tabooupdate
     * @return void
     */
    public function test_user_can_update_taboo_food_successfully()
    {
        // Cari user id berdasarkan email yang sudah ada
        $user = DB::table('users')->where('email', 'tepi2@gmail.com')->first();
        if (!$user) {
            $this->fail('User tepi2@gmail.com belum ada di database.');
            return;
        }

        // Insert data makanan pantangan baru dengan nama unik
        DB::table('taboo_food')->insert([
            'user_id' => $user->id,
            'food_name' => 'sapi',
            'taboo' => 'alergi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'tepi2@gmail.com')
                ->type('password', '12345678')
                ->press('Sign In')
                ->assertSee('Dashboard')
                ->pause(1000)
                ->visit('/taboo-foods')
                ->assertSee('Daftar Makanan Pantangan');

            // Cari container makanan dengan data-food-name 'MakananTest123', klik edit
            $browser->with("[data-food-name='sapi']", function ($food) {
                $food->press('Edit');
            });

            // Tunggu modal muncul
            $browser->waitFor('.modal.show', 5);

            // Isi form edit modal
            $browser->whenAvailable('.modal.show', function ($modal) {
                $modal->clear('input[name="food_name"]')
                      ->type('input[name="food_name"]', 'babi')
                      ->select('select[name="taboo"]', 'kolesterol')
                      ->press('Ubah');
            });

            // Tunggu modal hilang
            $browser->waitUntilMissing('.modal.show', 5);

            // Pastikan data berubah tampil di halaman
            $browser->assertSee('babi');

        });
    }
}
