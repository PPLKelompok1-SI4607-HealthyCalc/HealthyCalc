<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RecipesTest extends DuskTestCase
{
    /**
     * Test untuk menambahkan resep baru dengan informasi lengkap.
     * @group resep
     */
    public function testAddNewRecipe(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/recipes')
                    ->assertSee('Manajemen Resep Makanan Sehat') // Pastikan halaman utama resep terlihat
                    ->clickLink('Tambah Resep') // Klik tombol tambah resep
                    ->assertPathIs('/recipes/create') // Pastikan diarahkan ke halaman tambah resep
                    ->assertSee('Tambah Resep Baru') // Pastikan halaman tambah resep terlihat
                    ->type('name', 'Resep Test') // Isi nama resep
                    ->type('calories', '500') // Isi kalori
                    ->type('time', '30') // Isi waktu memasak
                    ->select('tag', 'Diet') // Pilih tag nutrisi
                    ->type('ingredients', 'Bahan 1, Bahan 2') // Isi bahan-bahan
                    ->type('instructions', 'Langkah 1, Langkah 2') // Isi instruksi memasak
                    ->type('protein', '20') // Isi protein
                    ->type('carbs', '50') // Isi karbohidrat
                    ->type('fat', '10') // Isi lemak
                    ->press('Simpan') // Klik tombol simpan
                    ->assertPathIs('/recipes') // Pastikan diarahkan kembali ke halaman daftar resep
                    ->assertSee('Resep Test'); // Pastikan resep baru terlihat di daftar
        });
    }
}
