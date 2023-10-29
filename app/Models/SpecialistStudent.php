<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SpecialistStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'specialist_id',
        'status',
        'date',
        'updated_at'
    ];

    protected $hidden = [
        'created_at'
    ];

}
