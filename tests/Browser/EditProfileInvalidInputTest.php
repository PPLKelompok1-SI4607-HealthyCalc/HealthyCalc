<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditProfileInvalidInputTest extends DuskTestCase
{
    /**
     * Test edit profil dengan input tidak valid (kosongkan berat badan).
     *
     * @return void
     */
    public function testEditProfilDenganInputTidakValid()
    {
        // Membuat user dengan profil yang sudah lengkap
        $user = User::factory()->create();
        $user->profile()->create([
            'age' => 25,
            'height' => 170,
            'weight' => 60,
            'gender' => 'Laki-laki',
            'activity_level' => 'Sedentary',
            'is_vegetarian' => true,
            'is_low_calorie' => false,
            'is_gluten_free' => false,
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            // Login sebagai user dan mengunjungi halaman edit profil
            $browser->loginAs($user)
                    ->visit('/profile/edit') // Arahkan ke halaman edit profil
                    // Kosongkan input berat badan dan simpan
                    ->type('weight', '') // Mengosongkan kolom berat badan
                    ->press('Simpan') // Menekan tombol simpan
                    // Memastikan validasi muncul
                    ->assertSee('Berat badan tidak boleh kosong')
                    // Memastikan data berat badan tidak berubah
                    ->assertInputValue('weight', '60'); // Berat badan tetap 60
        });
    }
}
