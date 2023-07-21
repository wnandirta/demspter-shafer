<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    use HasFactory;
    protected $table = 'solusis';
    protected $guarded = [];

    public function tipe()
    {
        return $this->belongsTo(Tipe::class, 'tipe_id', 'id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id');
    }
}
