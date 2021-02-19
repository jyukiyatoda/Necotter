<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'image_file'
    ];

    public function users()
    {
        return $this -> belongsTo('App\Models\User','user_id');
    }
    //public function getLoginUserAllPosts($LoginUserId){
    //  return $this -> where('user_id', $LoginUserId) ->get();
    //}
    public function getUserAllPosts($UserId)
    {
        return $this -> where('user_id', $UserId) -> get();
    }

    public function getFollowUserPosts($followListId)
    {
        return $this -> where('user_id', $followListId) -> get();
    }
}