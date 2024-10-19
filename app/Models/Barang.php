<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'kategori_id',
        'ruangan_id',
        'satuan_id',
        'supplier_id',
        'jumlah',
        'harga_persatuan',
        'penyusutan',
        'tanggal_pembelian',
        'tanggal_maintenance',
        'kondisi',
        'deskripsi',
        'gambar',
        'bukti_pembelian',
    ];

    

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_harga = $model->harga_persatuan * $model->jumlah;
        });
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
