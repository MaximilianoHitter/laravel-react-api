<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'whatsapp',
        'telephone'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
