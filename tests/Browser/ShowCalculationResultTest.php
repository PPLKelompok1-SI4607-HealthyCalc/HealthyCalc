<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ShowCalculationResultTest extends DuskTestCase
{
    /**
     * Test menampilkan hasil perhitungan kalori, karbohidrat, protein, dan lemak.
     * @group calcnutrition
     */
    public function testShowCalculationResult()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'tepi1@gmail.com')           // isi email login
                ->type('password', '12345678')                // isi password login
                ->press('Sign In')                            // klik tombol login
                ->assertPathIs('/dashboard')                  // pastikan diarahkan ke /dashboard

                ->visit('/calculations')                      // buka halaman kalkulasi

                ->type('age', '25')                           // isi usia
                ->select('gender', 'Perempuan')               // pilih jenis kelamin
                ->type('height', '170')                        // isi tinggi badan
                ->type('weight', '60')                         // isi berat badan
                ->select('activity_level', 'Cukup Aktif')     // pilih tingkat aktivitas

                ->press('Hitung')                             // submit form

                ->waitForText('Kalori yang dibutuhkan per hari:', 10)  // tunggu sampai muncul teks hasil
                ->assertSee('Kalori yang dibutuhkan per hari:')
                ->assertSee('Protein yang dibutuhkan per hari:')
                ->assertSee('Karbohidrat yang dibutuhkan per hari:')
                ->assertSee('Lemak yang dibutuhkan per hari:');
        });
    }
}
