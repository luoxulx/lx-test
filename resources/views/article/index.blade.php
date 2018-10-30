@extends('home.master')
@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">From the Firehose</h3>
        <!-- /.post list start -->
        @forelse($articles as $item)
        <div class="blog-post">
            <h3 class="blog-post-title"><a href="{{ url($item->slug) }}">{{ $item->title }}</a></h3>
            <p class="blog-post-meta"><em>{{ date('F d Y D') }}</em> <cite>by</cite>&nbsp;&nbsp;<a href="javascript:;">Chris</a></p>
            <p><a href="{{ url($item->slug) }}">{{ $item->description }}</a></p>
        </div>
        @empty
            <cite>NULL</cite>
        @endforelse
        <!-- /.post list end -->
        <nav class="blog-pagination">
            {{ $articles->links() }}
        </nav>
    </div>
    <!-- /.blog-main -->
    @include('home.aside')
@stop
