<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'name',
        'last_name',
        'profile_picture_url'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function trainer():HasOneThrough{
        return $this->hasOneThrough(TrainerStudent::class, Trainer::class)->firstWhere('status', '=', 'Activo');
    }

    public function goals():HasMany{
        return $this->hasMany(StudentGoal::class);
    }

    public function payments():HasMany{
        return $this->hasMany(Payment::class);
    }
}
