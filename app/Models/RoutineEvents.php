<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoutineEvents extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_routine_id',
        'date',
        'student_feedback',
        'description'
    ];

    public function routine():BelongsTo{
        return $this->belongsTo(TrainerRoutine::class, 'trainer_routine_id');
    }
}
