<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainerStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'student_id',
        'trainer_id',
        'status_student_id',
        'date',
        'updated_at'
    ];

    protected $hidden = [
        'created_at'
    ];

    public function status_student():BelongsTo
    {
        return $this->belongsTo(StatusStudent::class, 'status_student_id');
    }
}
