@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <form action="{{ route('categories.create') }}" method="GET">
                                @csrf
                                <button type="submit" class="fa fa-plus rounded-pill btn-info"></button>
                                <span>Add a new category</span>
                            </form>
                        </div>
                    </div>
                    @if($categories->isEmpty())
                        <div class="alert alert-info mt-3" role="alert">
                            No categories found.
                        </div>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Categories</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
