<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CreateProfileTest extends DuskTestCase
{
    /** @test */
    public function user_can_create_profile()
    {
        Storage::fake('public'); // fake storage untuk upload file

        $this->browse(function (Browser $browser) {
            $browser->visit('/profile/create')
                ->attach('profile_photo', __DIR__.'/files/test_photo.jpg') // pastikan file ini ada
                ->type('name', 'Yesi Aulia')
                ->type('email', 'yesi@example.com')
                ->type('age', '25')
                ->select('gender', 'Perempuan')
                ->type('height', '160')
                ->type('weight', '55')
                ->select('activity_level', 'Sangat Aktif')
                ->check('diet[]', 'Vegetarian')
                ->check('diet[]', 'Rendah Kalori')
                ->press('Simpan Profil')
                ->assertPathIs('/profile') // pastikan route redirect
                ->assertSee('Profil berhasil disimpan'); // pastikan pesan sukses
        });
    }
}
