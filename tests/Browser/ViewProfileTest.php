<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ViewProfileTest extends DuskTestCase
{
    /**
     * Test untuk melihat data profil positif.
     *
     * @return void
     */
    public function testMelihatDataProfilPositif()
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
            // Login sebagai user dan mengunjungi halaman profil
            $browser->loginAs($user)
                    ->visit('/profile')  // Arahkan ke halaman profil
                    // Memastikan data tampil dengan benar
                    ->assertSee($user->name)
                    ->assertSee($user->profile->age)
                    ->assertSee($user->profile->height)
                    ->assertSee($user->profile->weight)
                    ->assertSee($user->profile->gender)
                    ->assertSee($user->profile->activity_level)
                    ->assertSee('Vegetarian')
                    ->assertDontSee('Rendah Kalori')  // Memastikan hanya preferensi yang sesuai yang tampil
                    ->assertDontSee('Bebas Gluten');
        });
    }
}
