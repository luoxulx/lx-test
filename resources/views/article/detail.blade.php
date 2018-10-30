@extends('home.master')
@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">{{ $article->title }}</h3>
        <p class="blog-post-meta"><em>{{ date('F d Y D') }}</em> <cite>by</cite>&nbsp;&nbsp;<a href="javascript:;">Chris</a></p>
        <div class="blog-post">
            {!! $article->content['html'] !!}
        </div>
    </div>
    <!-- /.blog-main -->
    @include('home.aside')
@stop
