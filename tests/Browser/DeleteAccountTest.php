<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteAccountTest extends DuskTestCase
{
    /**
     * Test hapus akun permanen dan logout otomatis.
     *
     * @return void
     */
    public function testHapusAkunPermanen()
    {
        // Membuat user untuk melakukan pengujian
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            // Login sebagai user dan mengunjungi halaman profil
            $browser->loginAs($user)
                    ->visit('/profile') // Halaman profil
                    // Klik tombol "Hapus Akun"
                    ->click('@delete-account') // Pastikan tombol ini memiliki atribut @delete-account
                    // Konfirmasi penghapusan akun
                    ->press('Ya, Hapus Akun') // Tombol konfirmasi penghapusan
                    // Memastikan logout otomatis
                    ->assertPathIs('/login') // Harus diarahkan ke halaman login
                    // Memastikan akun tidak bisa mengakses halaman profil
                    ->visit('/profile') 
                    ->assertSee('Anda belum login'); // Harus melihat pesan bahwa pengguna belum login
        });
    }
}
