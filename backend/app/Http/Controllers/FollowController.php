<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Models\Following;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(Request $request,Following $following,$id)
    {
        $LoginUser = $request -> user();
        $LoginUserId = $LoginUser -> id;
        
        #Listとして取得すべきだけど、要素一つのため配列として取得できていない
        #Modelで一回条件分岐さデータ取得した方が効率よさそう。フォローアンフォローマイページでも使う為
        //$getFollowList = $following -> getFollowList($LoginUserId);
        //$isFollowing = in_array($id,$getFollowList);
        $isFollowing = $following -> isFollowing($LoginUserId,$id);
        
        if($isFollowing == false)
        {
            $following = new Following;
            $following -> user_id = $LoginUserId;
            $following -> following_user_id = $id;
            $following ->save();
            return back();
        }
    }

    public function unfollow(Request $request,Following $following,$id)
    {
        $LoginUser = $request -> user();
        $LoginUserId = $LoginUser -> id;
        //$getFollowList = $following -> getFollowList($LoginUserId);
        //$isFollowing = in_array($id,$getFollowList);
        $isFollowing = $following -> isFollowing($LoginUserId,$id);

        if($isFollowing == true)
        {
            $following -> where('following_user_id', $id) -> delete();
            return back();
        }
    }


    public function followList(Request $request,Following $following,User $user)
    {
        $LoginUser = $request -> user();
        $LoginUserId = $LoginUser -> id;
        $getFollowListId = $following -> getFollowListId($LoginUserId);
        if($getFollowListId -> isEmpty())
        {
            abort(404);
        } else {
            $getFollowList = $user -> getFollowList($getFollowListId);
            $isFollowing = $following -> isFollowing($LoginUserId,$getFollowListId); 
        }

        return view('follow.followList',[
            'getFollowList' => $getFollowList,
            'isFollowing' => $isFollowing,
        ]);
    }


    public function followerList(Request $request,Following $following,User $user)
    {
        $LoginUser = $request -> user();
        $LoginUserId = $LoginUser -> id;
        $getFollowerListId = $following -> getFollowerListId($LoginUserId);
        if($getFollowerListId -> isEmpty())
        {
            abort(404);
        } else {
            $getFollowerList = $user -> getFollowerList($getFollowerListId);
            $isFollowing = $following -> isFollowing($LoginUserId,$getFollowerListId);
        }
      
        //$isFollowed = $following -> isFollowed($LoginUserId,$getFollowerListId);
        #follow button用のisfollowing判定
        //$getFollowListId = $following -> getFollowListId($LoginUserId);

        return view('follow.followerList',[
            'getFollowerList' => $getFollowerList,
            //'isFollowed' => $isFollowed,
            'isFollowing' => $isFollowing,
        ]);
    }
}
