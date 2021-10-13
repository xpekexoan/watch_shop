@extends('user.master')
@section('title')
    Blog
@endsection
@section('content')
    <div class="blog-area pt--40 pb--80 pt-md--30 pb-md--60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        @foreach($blogs as $item)
                        <div class="col-12 mb--30">
                            <article class="post listview sticky single-post format-image">
                                <div class="post-media">
                                    <div class="image">
                                        <a href="{{ route('blog.detail', ['id'=>$item->id]) }}"><img src="{{ asset('storage/'.$item->image) }}" alt="blog">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-info">
                                    <header class="entry-header">
                                        <div class="entry-meta">
                                            <span  class="post-date">{{ $item->created_at }}</span>
                                        </div>
                                        <h2 class="post-title">
                                            <a href="{{ route('blog.detail', ['id'=>$item->id]) }}">{{ $item->title }}</a>
                                        </h2>
                                    </header>
                                    <div class="post-content">
                                        <p class="intro">{{ strip_tags($item->content) }}</p>
                                    </div>
                                    <a href="{{ route('blog.detail', ['id'=>$item->id]) }}" class="btn btn-read-more btn-style-2">Đọc tiếp</a>
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="pagination-wrap justify-content-center">
                                {{ $blogs->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
