<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nama_kategori'];
    public $timestamps = true;

    public function resep()
    {
        return $this->hasMany(Resep::class, 'id_kategori');
    }
}
