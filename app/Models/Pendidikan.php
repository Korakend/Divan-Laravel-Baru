<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
     protected $table = 'Pendidikan_1234';

    protected $fillable = [
        'biodata_id', 'nama_sekolah', 'jurusan',
        'tahun_mulai', 'tahun_selesai'
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'biodata_id');
    }
}
