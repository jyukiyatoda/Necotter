<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function editProfile()
    {
        $LoginUser = Auth::user();

        return view('UserProfile.profileEdit', [
            'LoginUser' => $LoginUser,
    ]);
    }

    public function updateProfile(Request $request)
    {
        $LoginUserId = Auth::id();
        $updateLoginUser = $request->all();
        
        unset($updateLoginUser['_token']);
        User::updateLoginUser($LoginUserId,$updateLoginUser);
        
        return redirect()->route('UserProfile.edit');;
    }
}
