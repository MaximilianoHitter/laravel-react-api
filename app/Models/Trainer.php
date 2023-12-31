<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable =[
        'id_user',
        'name',
        'last_name',
        'profile_picture_url',
        'day_of_birth',
        'weight',
        'height',
        'description'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user():HasOne{
        return $this->hasOne(User::class);
    }

    public function certificated():HasMany{
        return $this->hasMany(Certificate::class);
    }

    public function students():BelongsToMany{
        return $this->belongsToMany(Student::class, 'trainer_students')->withPivot('id','status_student_id', 'date');
    }

}
