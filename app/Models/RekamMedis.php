<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = false;
    protected $fillable = [
        'created_at', 'anamnesa', 'temuan_klinis', 'diagnosa',
        'idpet', 'dokter_pemeriksa'
    ];

    protected $dates = ['created_at'];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }

    public function details()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',   // INI YANG WAJIB DITAMBAH
        ];
    }
}