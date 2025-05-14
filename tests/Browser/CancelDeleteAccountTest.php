<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CancelDeleteAccountTest extends DuskTestCase
{
    /**
     * Test membatalkan penghapusan akun.
     *
     * @return void
     */
    public function testCancelHapusAkun()
    {
        // Membuat user untuk melakukan pengujian
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            // Login sebagai user dan mengunjungi halaman profil
            $browser->loginAs($user)
                    ->visit('/profile') // Halaman profil
                    // Klik tombol "Hapus Akun"
                    ->click('@delete-account') // Pastikan tombol ini memiliki atribut @delete-account
                    // Batalkan penghapusan akun
                    ->press('Batal') // Tombol batal pada konfirmasi
                    // Memastikan halaman profil tetap muncul dan tidak ada perubahan pada data
                    ->assertSee('Pengaturan Profil') // Menampilkan halaman profil
                    ->assertSee($user->name) // Nama pengguna harus tetap ada
                    ->assertSee($user->email); // Email pengguna harus tetap ada
        });
    }
}
