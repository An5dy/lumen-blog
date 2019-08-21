<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $fillable = [
        'avatar',
        'title',
        'sketch',
    ];

    public $timestamps = false;
}
