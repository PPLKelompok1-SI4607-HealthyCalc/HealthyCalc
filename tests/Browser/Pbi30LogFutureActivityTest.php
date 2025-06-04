<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User; // Tetap dibutuhkan untuk mengambil user_id di akhir


class Pbi30LogFutureActivityTest extends DuskTestCase // Nama kelas baru yang lebih sesuai
{
    use DatabaseMigrations;

    /**
     *
     * @group pbi30-direct-login
     */
    public function testRecordActivityWithFutureDateFailsDirectLogin(): void
    {
        // Tidak ada User::create() di sini.
        // Tes ini berasumsi user yesitra25@gmail.com sudah ada di database.

        $this->browse(function (Browser $browser) {
            $userEmail = 'yesitra25@gmail.com';
            $userPassword = '12345678';

            // Langkah 1: Login ke aplikasi dengan kredensial yang sudah ada
            $browser->visit('/login')
                    ->type('email', $userEmail)
                    ->type('password', $userPassword)
                    ->press('Sign In'); // Sesuaikan teks tombol 'Sign In' jika berbeda

            // Pastikan login berhasil (misalnya, dengan melihat teks 'Dashboard')
            $browser->assertSee('Dashboard')
                    ->pause(1000);

            // Langkah 2: Kunjungi halaman riwayat aktivitas fisik
            // Ganti '/activities' dengan URL yang benar jika berbeda
            $browser->visit('/activities')
                    ->pause(1000);

            // Langkah 3: Klik tombol "+ Tambah Aktivitas" untuk membuka modal
            $browser->click('p[data-bs-target="#exampleModal"]')
                    ->waitFor('#exampleModal.show', 5);

            // Langkah 4: Isi form di dalam modal dengan tanggal di masa depan
            $browser->within('#exampleModal', function (Browser $modal) {
                $futureDate = date('Y-m-d', strtotime('+4 days'));
                $activityNameForTest = 'Aktivitas Future Direct Login';

                $modal->select('intensity_level', 'Sedang')
                      ->type('activity_name', $activityNameForTest)
                      ->type('duration_minutes', '60')
                      ->type('calories_burned', '300')
                      ->type('activity_date', $futureDate)
                      ->press('Tambah');
            });
        });
    }
}