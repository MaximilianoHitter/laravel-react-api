<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'name',
        'last_name',
        'profile_picture_url',
        'day_of_birth',
        'weight',
        'height',
        'description'
    ];

    public function branches():HasManyThrough{
        return $this->hasManyThrough(Branch::class, SpecialistBranch::class);
    }

    public function students():HasManyThrough{
        return $this->hasManyThrough(Student::class, SpecialistStudent::class);
    }
}
