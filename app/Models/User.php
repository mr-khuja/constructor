<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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

    public function role()
    {
        if ($this->role == 0) {
            $role = 'Гость';
        } elseif ($this->role == 1) {
            $role = 'Модератор';
        } elseif ($this->role == 0) {
            $role = 'Администратор';
        }
        return $role;
    }

    public function logs()
    {
        return $this->hasMany('App\Models\Site\Log', 'user_id', 'id')->orderBy('id', 'DESC');
    }
}
