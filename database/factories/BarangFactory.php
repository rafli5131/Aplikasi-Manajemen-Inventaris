<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\Satuan;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $harga = $this->faker->numberBetween(10000, 10000000);
        $jumlah = $this->faker->numberBetween(1, 100);

        return [
            'kode' => $this->faker->unique()->bothify('BRG-#####'),
            'nama' => $this->faker->words(3, true),
            'kategori_id' => Kategori::factory(),
            'ruangan_id' => Ruangan::factory(),
            'satuan_id' => Satuan::factory(),
            'supplier_id' => Supplier::factory(),
            'jumlah' => $jumlah,
            'harga_persatuan' => $harga,
            'total_harga' => $harga * $jumlah,
            'penyusutan' => $this->faker->numberBetween(0, 1000000),
            'tanggal_pembelian' => $this->faker->date(),
            'tanggal_maintenance' => $this->faker->optional()->date(),
            'kondisi' => $this->faker->randomElement(['Baik', 'Rusak', 'Perbaikan', 'Hilang']),
            'deskripsi' => $this->faker->text(200),
            'gambar' => null, // Or handle image generation if needed
            'bukti_pembelian' => null,
        ];
    }
}
