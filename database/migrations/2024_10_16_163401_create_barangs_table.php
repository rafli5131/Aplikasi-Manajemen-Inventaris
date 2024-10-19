<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->foreignId('kategori_id')->constrained('kategoris');
            $table->foreignId('ruangan_id')->constrained('ruangans');
            $table->foreignId('satuan_id')->constrained('satuans');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers');
            $table->integer('jumlah');
            $table->integer('harga_persatuan');
            $table->integer('total_harga')->nullable();
            $table->integer('penyusutan')->nullable();
            $table->date('tanggal_pembelian');
            $table->date('tanggal_maintenance')->nullable();
            $table->string('kondisi');
            $table->string('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->string('bukti_pembelian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
