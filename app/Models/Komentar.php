<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'isi_komentar', 'id_resep', 'id_user'];
    public $timestamp = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep');
    }

}
