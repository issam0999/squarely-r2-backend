<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    public $fillable = [
        'name',
        'description',
        'location',
        'phone',
        'phone1',
        'email',
        'email1',
        'logo',

    ];
}
