@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                投稿の編集
            </h1>

            <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <fieldset class="mb-4">
                    <div class="form-group">
                        <label for="title">
                            タイトル
                        </label>
                        <input
                            id="title"
                            name="title"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            value="{{ old('title') ?: $post->title }}"
                            type="text"
                        >
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="content">
                            内容
                        </label>

                        <textarea
                            id="content"
                            name="content"
                            class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                            rows="4"
                        >{{ old('content') ?: $post->content }}</textarea>
                        @if ($errors->has('content'))
                            <div class="invalid-feedback">
                                {{ $errors->first('content') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="body">
                            画像（任意） 
                        </label>
                        <br>
                        <input type="file" name="image_file" class="form-control {{ $errors->has('image_file') ? 'is-invalid' : '' }}" value="{{ old('image_file') ?: $post->image_file }}"
                        >
                        @if ($errors->has('image_file'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image_file') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-5">
                        <a class="btn btn-secondary" href="{{ route('posts.show', ['post' => $post]) }}">
                            戻る
                        </a>

                        <button type="submit" class="btn btn-primary">
                            更新
                        </button>
                    </div>
                </fieldset>
            </form>

            <form style="display: inline-block;" method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger">削除する</button>
            </form>
        </div>
    </div>
@endsection