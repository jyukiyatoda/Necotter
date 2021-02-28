@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @foreach ($followUserPosts as $post)
            <div class="card mb-4">
                <div class="card-header">
                    ユーザー名　{{$post->users->name}}
                </div>
                <div class="card-body">
                    <h5 class="card-text">
                        {{ $post->title }}
                    </h5>
                    <p class="card-text">
                        {{ $post->content }}
                    </p>
                </div>
                @isset($post->image_file)
                <div>
                    <img src="{{ asset('storage/'.$post->image_file)}}" width="200px" height="200px">
                </div>
                @endisset

                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $post->created_at->format('Y.m.d') }}
                    </span>
                    <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
                    詳細ページ
                    </a>
                    <a class="card-link" href="{{ route('mypage.show', ['id' => $post->user_id]) }}">
                    Mypage
                    </a>
                </div>
            </div>
            @endforeach


        @empty($post)
            <div class="card mb-4">
                <div class="card-header">
                    Nothing Data
                </div>
                    <div class="card-body">
                        <p class="card-text">
                            フォローしているユーザーの投稿がありません
                        </p>
                    </div>
             </div>
        @endempty
    </div>
@endsection