<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'tanggal',
        'deskripsi',
        'foto',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
