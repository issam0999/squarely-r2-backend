<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 0;
    public const TYPE_CONTACT = 1;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'type_id',
        'date_of_birth',
        'country_id',
        'center_id',
        'status',
        'address','city_id',
        'image',
    ];
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
