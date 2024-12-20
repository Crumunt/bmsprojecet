<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageTasks extends Model
{
    //
    protected $fillable = [
        'task_header',
        'task_name',
        'task_desc',
        'end_date'
    ];
}
