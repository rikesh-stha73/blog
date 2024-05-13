<!-- resources/views/posts/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>
                <p style="font-size: 0.75em; padding-left: 20px;">{{$post->created_ago}}</p>
                <div class="card-body">
                    <p>{{ $post->content }}</p>
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="max-width: 100%;">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
