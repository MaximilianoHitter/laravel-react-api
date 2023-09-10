<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'profile_picture_url'
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

    public function students():HasManyThrough{
        return $this->hasManyThrough( Student::class, TrainerStudent::class);
    }
}
