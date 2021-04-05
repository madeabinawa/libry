<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;

    // CUSTOM TABLE NAME
    protected $table = 'penerbit';
    // CUSTOME PRIMARYKEY
    protected $primaryKey = 'id_penerbit';
    // FILLABLE COLUMNS
    protected $fillable = [
        'nama_penerbit',
        'kota',
        'telp'
    ];

    // RELATIONSHIP
    public function buku()
    {
        return $this->hasMany(Buku::class);
    }
}
