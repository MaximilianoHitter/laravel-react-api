<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineEvents extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_routine',
        'date',
        'student_feedback',
        'description'
    ];
}
