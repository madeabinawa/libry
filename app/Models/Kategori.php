<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // SET TABLE NAME
    protected $table = 'kategori';

    // SET PK COLUMN
    protected $primaryKey = 'id_kategori';

    // SET MASS ASSIGNMENT COLUMN
    protected $fillable = [
        'jenis_kategori'
    ];

    // RELATIONSHIP
    public function buku()
    {
        return $this->hasMany(Buku::class);
    }
}
