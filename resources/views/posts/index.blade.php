@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('post.create') }}" method="GET">
                        @csrf
                        <button type="submit" class="fa fa-plus rounded-pill btn-info"></button>
                        <span>Create a new post?</span>
                    </form>
                </div>
            </div>
            @if($posts->isEmpty())
                <div class="alert alert-info mt-3" role="alert">
                    No posts found.
                </div>
            @else
                @foreach($posts as $post)
                    <div class="card mt-3">
                        <div class="card-body">
                            <form action="{{route('post.show',['post' => $post])}}">
                                <h3>{{ $post->title }} <button class="fa fa-eye btn-sm" style="background-color: transparent; border: none;"></button></h3>
                            </form>
                            <p style="font-size: 0.75em;">{{$post->created_ago}}</p>
                            <h8>{{ $post->content }}</h8><br>
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="max-width: 100%;">
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
