<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProfileTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_fill_profile_after_registration()
    {
        // Buat user dummy
        $user = User::factory()->create([
            'name' => 'Yesi Tester',
            'email' => 'yesi@example.com',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/profile/create') // Ganti jika route-nya berbeda
                ->assertSee('Lengkapi Profil Anda')
                ->attach('profile_photo', __DIR__.'/files/test_photo.jpg')
                ->type('name', 'Yesi Tester')
                ->type('email', 'yesi@example.com')
                ->type('age', '25')
                ->select('gender', 'Perempuan')
                ->type('height', '160')
                ->type('weight', '55')
                ->select('activity_level', 'Cukup Aktif')
                ->check('diet[]', 'Vegetarian')
                ->check('diet[]', 'Rendah Kalori')
                ->press('Simpan Profil')
                ->waitForText('Profil berhasil disimpan') // pastikan flash message muncul
                ->assertSee('Profil berhasil disimpan');
        });
    }
}
