<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\Satuan;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Master Data
        $kategoris = Kategori::factory(10)->create();
        $ruangans = Ruangan::factory(10)->create();
        $satuans = Satuan::factory(5)->create();
        $suppliers = Supplier::factory(10)->create();

        // Create Barang using the master data
        Barang::factory(50)->recycle($kategoris)->recycle($ruangans)->recycle($satuans)->recycle($suppliers)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
