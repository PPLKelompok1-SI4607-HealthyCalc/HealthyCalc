<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\DB;

class DeleteTabooFoodTest extends DuskTestCase
{
    /**
     * Test user can update taboo food successfully.
     *
     * @group taboodelete
     * @return void
     */
    public function test_user_can_delete_taboo_food_successfully()
    {
<<<<<<< Updated upstream

=======
        // Cari user id berdasarkan email yang sudah ada
>>>>>>> Stashed changes
        $user = DB::table('users')->where('email', 'tepi2@gmail.com')->first();
        if (!$user) {
            $this->fail('User tepi2@gmail.com belum ada di database.');
            return;
        }

<<<<<<< Updated upstream
  
=======
        // Insert data makanan pantangan baru dengan nama unik
>>>>>>> Stashed changes
        DB::table('taboo_food')->insert([
            'user_id' => $user->id,
            'food_name' => 'ikan',
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
            $browser->with("[data-food-name='ikan']", function ($food) {
                $food->press('Hapus');
            });


            $browser->assertDontSee('ikan');

        });
    }
}
