<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // use HasFactory;
    protected $fillable = [
        'name',
        'email'
    ];

    public function login()
    {
        return $this->hasOne(Login::class);
    }

}
