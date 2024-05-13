@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('news.create') }}" method="GET">
                        @csrf
                        <button type="submit" class="fa fa-plus rounded-pill btn-info"></button>
                        <span>Create a new news?</span>
                    </form>
                </div>
            </div>
            @if($news->isEmpty())
                <div class="alert alert-info mt-3" role="alert">
                    No news found.
                </div>
            @else
                @foreach($news as $item)
                    <div class="card mt-3">
                        <div class="card-body">
                            <h3>{{ $item->headline }}</h3>
                            <p>{{ Str::limit($item->content, 100, '...') }}</p>
                            <a href="{{ route('news.show', $item->id) }}" >...Read More</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
