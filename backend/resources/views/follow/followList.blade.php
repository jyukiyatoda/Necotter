@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($getFollowList as $user)
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $user->name }}</p>
                            </div>

                            <?
                            /*
                            @if (auth()->user()->isFollowed($user->id))
                                <div class="px-2">
                                    <span class="px-1 bg-secondary text-light">フォローされています</span>
                                </div>
                            @endif
                            */?>

                            <div class="d-flex justify-content-end flex-grow-1">
                                @if ($isFollowing === true)
                                    <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                                        @csrf
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
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    @empty($getFollowList)
            <div class="card mb-4">
                <div class="card-header">
                    Nothing Data
                </div>
                    <div class="card-body">
                        <p class="card-text">
                            フォローしているユーザーがいません
                        </p>
                    </div>
             </div>
    @endempty
@endsection