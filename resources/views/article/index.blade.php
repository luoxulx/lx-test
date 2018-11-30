@extends('layouts.home')
@section('content')
    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h2 class="my-4">Page Heading
            <small>Secondary Text</small>
        </h2>

        <!-- Blog Post -->
        @forelse($articles as $item)
            <div class="card mb-4">
                <img class="card-img-top" src="{{ buildPicUrl($item->thumbnail) }}" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">{{ $item->title }}</h2>
                    <p>{{ $item->description }}</p>
                    <a href="{{ url($item->slug) }}" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    {{ $item->created_at }}
                    <a href="#">Start Bootstrap</a>
                </div>
            </div>
        @empty
            <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4 class="alert-heading">Warning!</h4>
                <p class="mb-0">Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra
                    augue. Praesent commodo cursus magna, <a href="#" class="alert-link">vel scelerisque nisl
                        consectetur et</a>.</p>
            </div>
        @endforelse
    <!-- Pagination -->
        {{ $articles->links() }}
    </div>

    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">
        @include('layouts.sidebar')
    </div>

    </div>
    </div>
@endsection
