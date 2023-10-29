<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusStudent extends Model
{
    use HasFactory;

    protected $table = 'status_students';

    protected $fillable = [
        'status'
    ];

    protected $casts = [
        'updated_at'=>'datetime:d/m/Y'
    ];
}
