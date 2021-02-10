<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'address',
        'email',
        'password',
        'address_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function isAdmin(){
        return $this->role_id == 1;
    }

    public function getProfileImageAttribute(){
        return $this->image
            ? "images/{$this->image->path}"
            : 'https://www.gravatar.com/avatar/404?d=mp';
    }
}