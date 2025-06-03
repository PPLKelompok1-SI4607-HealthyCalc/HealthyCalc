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
                ->type('email', 'tepi1@gmail.com')           
                ->type('password', '12345678')                
                ->press('Sign In')                            
                ->assertPathIs('/dashboard')                  

                ->visit('/calculations')                      

                ->type('age', '25')                           
                ->select('gender', 'Perempuan')               
                ->type('height', '170')                        
                ->type('weight', '60')                         
                ->select('activity_level', 'Cukup Aktif')    
                ->press('Hitung')                             

                ->waitForText('Kalori yang dibutuhkan per hari:', 10)  
                ->assertSee('Kalori yang dibutuhkan per hari:')
                ->assertSee('Protein yang dibutuhkan per hari:')
                ->assertSee('Karbohidrat yang dibutuhkan per hari:')
                ->assertSee('Lemak yang dibutuhkan per hari:');
        });
    }
}
