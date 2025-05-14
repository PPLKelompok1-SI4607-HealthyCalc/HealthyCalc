<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CreateProfileTest2 extends DuskTestCase
{
    /**
     * Test validasi input data profil dengan input tidak valid
     *
     * @return void
     */
    public function testProfileFormValidationError()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/profile/create') // ganti dengan URL form profilmu
                    ->type('name', 'Test User')
                    ->type('email', 'testuser@example.com')
                    ->type('age', 'dua puluh') // umur pakai huruf
                    ->type('height', -170) // tinggi badan negatif
                    ->type('weight', 65)
                    ->select('gender', 'Laki-laki')
                    ->select('activity_level', 'Cukup Aktif')
                    ->check('diet[]', 'Vegetarian')
                    ->press('Simpan Profil')
                    ->assertPathIs('/profile/create') // masih di halaman yang sama karena error
                    ->assertSee('The age must be a number') // contoh error Laravel default
                    ->assertSee('The height must be at least 50'); // contoh error validasi
        });
    }
}
