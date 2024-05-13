@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @auth
            <div class="card" style="margin-top: 30px;">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <h3>Welcome, {{ Auth::user()->name }}</h3>
                </div>
            </div>
            <div class="mt-3">
                @php
                    $user = Auth::user();
                @endphp

                <div class="row">
                    @if($user->hasRole('admin'))
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('users.index') }}" class="btn btn-primary btn-lg btn-block">
                                    <i class="fas fa-user"></i> User Management
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($user->hasRole('admin') || $user->hasRole('post_manager'))
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('categories.index') }}" class="btn btn-primary btn-lg btn-block">
                                    <i class="fas fa-file-list"></i> Categories
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('post.index') }}" class="btn btn-primary btn-lg btn-block">
                                    <i class="fas fa-file-alt"></i> Posts
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($user->hasRole('admin') || $user->hasRole('news_manager'))
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('news.index') }}" class="btn btn-primary btn-lg btn-block">
                                    <i class="fas fa-newspaper"></i> News
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection
