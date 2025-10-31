<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    protected $fillable = ['idrole', 'iduser'];
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
