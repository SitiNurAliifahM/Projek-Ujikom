<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nama_resep', 'id_kategori', 'deskripsi', 'gambar', 'id_user', 'status'];
    public $timestamps = true;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'id_resep');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_resep');
    }

    // menghapus image
    public function deleteGambar(){
        if($this->gambar && file_exists(public_path('gambars/resep' . $this->gambar))){
            return unlink(public_path('gambars/resep' . $this->gambar));
        }
    }
}
