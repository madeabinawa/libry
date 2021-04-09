<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    // CUSTOM TABLE NAME
    protected $table = 'buku';
    // CUSTOM PRIMARYKEY
    protected $primaryKey = 'id_buku';
    // FILLABLE COLUMNS
    protected $fillable = [
        'id_kategori',
        'id_penerbit',
        'isbn',
        'judul',
        'tahun_terbit',
        'jumlah',
        'gambar'
    ];

    // RELATIONSHIP
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
