<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineEvents extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_routine_id',
        'date',
        'student_feedback',
        'description'
    ];
}
