<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ChangeActivityLevelTest extends DuskTestCase
{
    /**
     * Test login, isi form kalkulasi, dan verifikasi hasil.
     * @group changeactivity
     */
    public function testLoginAndChangeActivityLevel()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'tepi1@gmail.com')          
                ->type('password', '12345678')               
                ->press('Sign In')                            
                ->assertPathIs('/dashboard')                  

                ->visit('/calculations')                      // buka halaman kalkulasi

                ->type('age', '25')                           // isi usia
                ->select('gender', 'Perempuan')               // pilih jenis kelamin
                ->type('height', '170')                        // isi tinggi badan
                ->type('weight', '60')                         // isi berat badan
                ->select('activity_level', 'Cukup Aktif')     // pilih tingkat aktivitas

                ->press('Hitung')                             // submit form

                ->assertSee('Kalori yang dibutuhkan per hari:'); // verifikasi hasil muncul
        });
    }
}
