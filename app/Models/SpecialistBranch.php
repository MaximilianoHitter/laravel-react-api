<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_branch',
        'id_specialist'
    ];
}
