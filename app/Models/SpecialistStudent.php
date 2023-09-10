<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_student',
        'id_specialist',
        'status',
        'date',
        'updated_at'
    ];

    protected $hidden = [
        'created_at'
    ];
}
