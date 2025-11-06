<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< HEAD
        'center_id',
        'contact_id',
=======
        'contact_id',
        'center_id',
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
<<<<<<< HEAD

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
=======
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
<<<<<<< HEAD
=======

>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
}
