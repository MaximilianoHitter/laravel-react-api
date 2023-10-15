<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_student',
        'amount',
        'reason',
        'payment_type',
        'status',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'id_student');
    }

    public function routine(): HasOne{
        return $this->hasOne(TrainerRoutine::class, 'id_payment');
    }

    
}
