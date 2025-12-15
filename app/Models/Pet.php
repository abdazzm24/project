<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;
    protected $guarded = [];
    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idpet', 'idpet');
    }

    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idpet', 'idpet');
    }

    public function jenisHewan()
    {
        return $this->hasOneThrough(
            JenisHewan::class,      // model tujuan
            RasHewan::class,        // model perantara
            'idras_hewan',          // FK di tabel ras_hewan
            'idjenis_hewan',        // FK di tabel jenis_hewan
            'idras_hewan',          // FK di tabel pet
            'idjenis_hewan'         // PK di tabel ras_hewan
        );
    }

    protected $casts = [
        'tanggal_lahir' => 'date',
        'jenis_kelamin' => 'string',
    ];
}
