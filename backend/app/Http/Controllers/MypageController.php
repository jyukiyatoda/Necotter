<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Following;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function MypageShow(Request $request,Post $post,Following $following,$id)
    {
        $userId = $id;
        $user = DB::table('users')->where('id', $userId)->first();
        $LoginUser = $request->user();
        $LoginUserId = $LoginUser->id;

        #$getFollowList = $following -> getFollowList($LoginUser->id);
        #if(is_array($getFollowList)){
        #    $isFollowing = in_array($id,$getFollowList);
        #} else {
        #    $isFollowing = ($id == $getFollowList);
        #}


        #Todo
        #followしているユーザーの投稿も投稿ない場合の条件も必要

        $isFollowing = $following ->isFollowing($LoginUserId,$userId);
        $userAllPosts = $post->getUserAllPosts($id);

        return view('Mypage.mypageShow', [
            'LoginUser' => $LoginUser,
            'user' => $user,
            'userAllPosts' => $userAllPosts,
            'userId' => $userId,
            'isFollowing' => $isFollowing
        ]);

    }


}
