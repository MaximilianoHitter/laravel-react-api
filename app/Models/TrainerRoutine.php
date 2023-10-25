<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TrainerRoutine extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_student',
        'id_trainer',
        'id_student_goal',
        'name',
        'initial_date',
        'final_date',
        'id_routine_status',
        'id_payment',
        'amount',
        'color'
    ];

    public function events():HasMany{
        return $this->hasMany(RoutineEvents::class);
    }

    public function payment():HasOne{
        return $this->hasOne(Payment::class, 'id', 'id_payment');
    }

    public function student():BelongsTo{
        return $this->belongsTo(Student::class, 'id_student');
    }

    public function trainer():BelongsTo{
        return $this->belongsTo(Trainer::class, 'id_trainer');
    }

    public function goal():BelongsTo{
        return $this->belongsTo(StudentGoal::class, 'id_student_goal');
    }

    public function status():BelongsTo{
        return $this->belongsTo(Status::class, 'id_routine_status');
    }
}
