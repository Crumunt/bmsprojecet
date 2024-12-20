<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_header',
        'task_name',
        'task_percentage',
        'percentage_completed',
        'building_id'
    ];

    public function building() {
        return $this->belongsTo(Building::class);
    }
}
