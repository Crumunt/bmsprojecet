<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory;
    protected $fillable = [
        'building_name',
        'contractor_name',
        'building_location',
        'budget',
        'completion_rate',
        'starting_date',
        'end_date'
    ];

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function contractor() {
        return $this->hasOne(User::class);
    }
}
