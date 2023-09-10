<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecialityPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_student',
        'id_specialist',
        'name',
        'description',
        'initial_date',
        'final_date',
        'id_payment',
        'student_feedback',
        'id_plan_status',
        'amount'
    ];

    public function student():BelongsTo{
        return $this->belongsTo(Student::class);
    }

    public function specialist():BelongsTo{
        return $this->belongsTo(Specialist::class);
    }

    public function payment():BelongsTo{
        return $this->belongsTo(Payment::class);
    }

    public function status():BelongsTo{
        return $this->belongsTo(Status::class);
    }
}
