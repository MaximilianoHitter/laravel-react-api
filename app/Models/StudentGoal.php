<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_student',
        'name',
        'description',
        'goal_status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function routines():HasMany{
        return $this->hasMany(TrainerRoutine::class);
    }
}
