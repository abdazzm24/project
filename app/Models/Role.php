<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $timestamps = false;
    protected $fillable = ['nama_role', 'keterangan'];

    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'idrole', 'idrole');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser');
    }
}
