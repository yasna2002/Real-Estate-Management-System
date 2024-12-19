<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string role
 * @property string email
 * @property string name
 * @property string phone_number
 */

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const ADMIN = 'admin';
    const USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [
        'id',
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
            'password' => 'hashed',
        ];
    }

    public function properties(){
        return $this->hasMany(Property::class);
    }

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

    public function getRoles(): array
    {
        return [
            self::ADMIN,
            self::USER,
        ];
    }
    public function role()
    {
       return $this->role;
    }
}
