<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;

    public function followedUser()
    {
        return $this -> belongsTo('App\Models\User','user_id');
    }

    public function followingUser()
    {
        return $this -> belongsTo('App\Models\User','following_user_id');
    }


    public function isFollowing($LoginUserId,$followUserId)
    {
        return $this -> where('user_id',$LoginUserId) -> whereIn('following_user_id',[$followUserId]) -> exists();
    }
    public function isFollowed($LoginUserId,$followerUserId)
    {
        return $this -> where('following_user_id',$LoginUserId) -> whereIn('user_id',[$followerUserId]) -> exists();
    }


    public function getFollowListId(Int $LoginUserId)
    {
        return $this -> where('user_id',$LoginUserId) -> pluck('following_user_id');
    }

    public function getFollowerListId(Int $LoginUserId)
    {
        return $this -> where('following_user_id',$LoginUserId) -> pluck('user_id');
    }
}
