@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $news->headline }}</div>

                    <div class="card-body">
                        @if ($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->headline }}" class="img-fluid">
                        @endif
                        <p>{{ $news->content }}</p>
                        <p class="text-muted">Published {{ $news->created_ago }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
