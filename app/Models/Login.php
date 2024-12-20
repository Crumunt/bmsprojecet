<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $fillable = [
        'user_id',
        'password',
        'user_type',
        'last_login_attempt'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function isUserType($type) {
        // returns boolean
        // checks if user type is same with parameter
        return $this->user_type === $type;
    }
}
