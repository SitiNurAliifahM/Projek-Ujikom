<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'id_user', 'id_resep', 'is_like', 'added_at'];
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
