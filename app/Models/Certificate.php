<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_trainer',
        'name',
        'date',
        'expire_date',
        'pdf_url'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
