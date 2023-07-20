<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengetahuan extends Model
{
    use HasFactory;
    protected $table = 'pengetahuans';
    protected $guarded = [];

    public function tipe()
    {
        return $this->belongsTo(Tipe::class, 'tipe_id', 'id');
    }

    public function karakteristik()
    {
        return $this->belongsTo(Karakteristik::class, 'karakteristik_id', 'id');
    }
}
