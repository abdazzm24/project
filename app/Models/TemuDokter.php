<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    public $timestamps = false;
    protected $guarded = [];

    protected $casts = [
        'waktu_daftar' => 'datetime',  // atau 'datetime:Y-m-d H:i:s' jika formatnya pasti
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function roleuser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    // Scope untuk filter tanggal
    public function scopeByDate($query, $date)
    {
        if ($date === 'all') return $query;
        return $query->whereDate('waktu_daftar', $date);
    }

    // Ambil nomor urut berikutnya hari ini
    public static function getNextNoUrut()
    {
        $today = Carbon::today()->toDateString();
        $max = self::whereDate('waktu_daftar', $today)->max('no_urut');
        return $max ? $max + 1 : 1;
    }

}
