@extends('layouts.home')
@section('content')
    <div class="col-lg-8">
        <!-- Title -->
        <h2 class="mt-4">{{ $article->title }}</h2>
        <!-- Author -->
        <p class="lead">by &nbsp;&nbsp;<a href="#">xxx xxx xxx</a></p>
        <hr>
        <!-- Date/Time -->
        <p>{{ $article->created_at }}</p>
        <hr>
        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{ buildPicUrl($article->thumbnail) }}" alt="{{ $article->title }}">
        <hr>
        <div class="main-content">
            {!! $article->content['html'] !!}
        </div>
        <!-- Comments Form -->
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @include('layouts.sidebar')
    </div>
@stop
