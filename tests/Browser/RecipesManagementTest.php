/**
 * Test untuk mengedit langkah memasak dan menyimpan perubahan
 * @group resep
 */
public function testEditCookingStepsAndSave(): void
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/recipes')
                ->assertSee('Manajemen Resep Makanan Sehat')
                ->click('a.text-blue-600') // Klik tombol edit (ikon pensil)
                ->assertSee('Edit Resep')
                // Simpan nama resep original untuk verifikasi
                ->waitFor('#instructions')
                ->value('#instructions', function ($currentValue) use ($browser) {
                    // Ubah langkah memasak
                    $newInstructions = 'Langkah 1: Siapkan bahan. Langkah 2: Masak. Langkah 3: Sajikan.';
                    $browser->type('instructions', $newInstructions);
                    
                    // Klik tombol Perbarui Resep
                    $browser->press('Perbarui Resep')
                            ->assertPathIs('/recipes')
                            ->assertSee('berhasil diperbarui');
                });
    });
}