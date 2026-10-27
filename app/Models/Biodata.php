<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
     protected $table = 'Biodata_1234';

    protected $fillable = [
        'nama', 'nim', 'jurusan', 'email',
        'telepon', 'alamat', 'tentang_saya', 'foto'
    ];

    public function pendidikan()
    {
        return $this->hasMany(Pendidikan::class, 'biodata_id');
    }

    public function keahlian()
    {
        return $this->hasMany(Keahlian::class, 'biodata_id');
    }
}
