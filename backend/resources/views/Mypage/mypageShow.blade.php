@extends('layouts.app')

@section('content')
@if(Auth::id() == $userId)
    <div class="container mt-4">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.create') }}">投稿する</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/userProfile">プロフィール編集</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('followList') }}">フォロー一覧</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('followerList') }}">フォロワー一覧</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('followUserPosts') }}">フォローユーザー投稿</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$LoginUser->name}}のMyPage</h5>
            </div>
        </div>
    </div>


    <div class="container mt-4">
        @foreach ($userAllPosts as $LoginUserAllPost)
            <div class="card mb-4">
                <div class="card-header">
                    {{ $LoginUserAllPost->title }}
                </div>
                <div class="card-body">
                    <p class="card-text">
                        {{ $LoginUserAllPost->content }}
                    </p>
                </div>
                @isset($LoginUserAllPost->image_file)
                <div>
                    <img src="{{ asset('storage/'.$LoginUserAllPost->image_file)}}" width="200px" height="200px">
                </div>
                @endisset

                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $LoginUserAllPost->created_at->format('Y.m.d') }}
                    </span>
                    <a class="card-link" href="{{ route('posts.show', ['post' => $LoginUserAllPost]) }}">
                    詳細ページ
                    </a>
                </div>
            </div>
        @endforeach

        @empty($LoginUserAllPost)
            <div class="card mb-4">
                <div class="card-header">
                    Nothing Data
                </div>
                    <div class="card-body">
                        <p class="card-text">
                            投稿がありません
                        </p>
                    </div>
            </div>
            <div class="mb-4">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                    投稿する
                </a>
            </div>
        @endempty
    </div>
    @else
    <div class="container mt-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">{{$user->name}}のMyPage</h5>
            </div>

            @if ($isFollowing === true)
            <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">                                {{ csrf_field() }}
                @method('delete')

                <button type="submit" class="btn btn-danger">フォロー解除</button>
            </form>
            @else
            <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                @csrf

                 <button type="submit" class="btn btn-primary">フォローする</button>
            </form>
            @endif
        </div>
    </div>

    <div class="container mt-4">
        @foreach ($userAllPosts as $UserAllPost)
            <div class="card mb-4">
                <div class="card-header">
                    {{ $UserAllPost->title }}
                </div>
                <div class="card-body">
                    <p class="card-text">
                        {{ $UserAllPost->content }}
                    </p>
                </div>
                @isset($UserAllPost->image_file)
                <div>
                    <img src="{{ asset('storage/'.$UserAllPost->image_file)}}" width="200px" height="200px">
                </div>
                @endisset

                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $UserAllPost->created_at->format('Y.m.d') }}
                    </span>
                </div>
            </div>
        @endforeach

        @empty($UserAllPost)
            <div class="card mb-4">
                <div class="card-header">
                    Nothing Data
                </div>

                @if ($isFollowing === true)
                <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">                                {{ csrf_field() }}
                    @method('delete')

                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                </form>
                @else
                <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-primary">フォローする</button>
                </form>
                @endif

                    <div class="card-body">
                        <p class="card-text">
                            投稿がありません
                        </p>
                    </div>
            </div>
            <div class="mb-4">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                    投稿する
                </a>
            </div>
        @endempty
    </div>

    @endif
@endsection