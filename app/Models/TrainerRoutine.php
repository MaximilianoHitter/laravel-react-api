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
        return $this->hasOne(Payment::class);
    }

    public function student():BelongsTo{
        return $this->belongsTo(Student::class);
    }

    public function trainer():BelongsTo{
        return $this->belongsTo(Trainer::class);
    }

    public function goal():BelongsTo{
        return $this->belongsTo(StudentGoal::class);
    }
}
