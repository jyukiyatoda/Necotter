@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                {{ $post->title }}
            </h1>

            <p class="mb-5">
            @csrf
                {{$post->content}}
            </p>
            
            @isset($post->image_file)
            <p>
            <img src="{{ asset('storage/'.$post->image_file)}}" width="200px" height="200px">
            </p>
            @endisset

        </div>
    </div>
    <div class="container mt-4">
        <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">
            編集する
        </a>

        <form style="display: inline-block;" method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger">削除する</button>
        </form>
    </div>
@endsection