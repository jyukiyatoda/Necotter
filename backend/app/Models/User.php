<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function scopeUpdateLoginUser($query,$LoginUserId,$updateLoginUser)
    {
        return $query->where(
            'id' , $LoginUserId)->update([
            'name' => $updateLoginUser['name'],
            'email' => $updateLoginUser['email']
        ]);
    }

    public function posts()
    {
        return $this -> hasMany('App\Models\Post');
    }

    public function followings()
    {
        return $this -> hasMany('App\Models\Following');
    }


    public function getFollowList($getFollowListId)
    {
        return $this -> where('id',[$getFollowListId]) -> get();
    }

    public function getFollowerList($getFollowerListId)
    {
        return $this -> where('id',[$getFollowerListId]) -> get();
    }
}
