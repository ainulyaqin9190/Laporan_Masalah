<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 
        'deskripsi',
        'mahasiswa_id',
        'status',
        'nomor_laporan',
        'status_updated_at'       
    ];

    protected $dates = [
    'created_at',
    'updated_at',
    'status_updated_at',
];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

}
