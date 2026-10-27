<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keahlian extends Model
{
    protected $table = 'Keahlian_1234';

    protected $fillable = [
        'biodata_id', 'nama_keahlian', 'tingkat'
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'biodata_id');
    }
}
