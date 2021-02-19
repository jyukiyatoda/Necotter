@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                きょうのうんち
            </h1>

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <fieldset class="mb-4">
                    <div class="form-group">
                        <label for="title">
                            タイトル
                        </label>
                        <input
                            id="title"
                            name="title"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            value="{{ old('title') }}"
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
                            本文
                        </label>

                        <textarea
                            id="content"
                            name="content"
                            class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                            rows="4"
                        >{{ old('content') }}
                        </textarea>
                        @if ($errors->has('content'))
                            <div class="invalid-feedback">
                                {{ $errors->first('content') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="image_file">
                            画像（任意） 
                        </label>
                        <br>
                        <input type="file" name="image_file">
                    </div>

                    <div class="mt-5">
                        <a class="btn btn-secondary" href="/">
                            戻る
                        </a>
                        <button type="submit" class="btn btn-primary">
                            投稿する
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
