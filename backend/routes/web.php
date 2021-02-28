<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FollowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/', [PostController::class, 'AllUsersPostsShow']);
Route::get('/home', [PostController::class, 'AllUsersPostsShow']);

Route::resource('posts', PostController::class)->except([
    'index'
]);;
Route::get('/followUserPosts', [PostController::class,'followUserPosts'])->name('followUserPosts');

Route::get('/mypage/{id}', [MypageController::class,'MypageShow'])->name('mypage.show');

Route::get('/userProfile', [UserProfileController::class,'editProfile'])->name('UserProfile.edit');
Route::post('/userProfile', [UserProfileController::class,'updateProfile'])->name('UserProfile.update');

// フォロー/フォロー解除を追加
Route::post('/mypage/{id}/follow', [FollowController::class,'follow'])->name('follow');
Route::delete('/mypage/{id}/unfollow', [FollowController::class,'unfollow'])->name('unfollow');

Route::get('/followList', [FollowController::class,'followList'])->name('followList');
Route::get('/followerList', [FollowController::class,'followerList'])->name('followerList');
