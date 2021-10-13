@extends('user.master')
@section('title')
    {{ $blog->title }}
@endsection
@section('content')
    <div class="single-post-area pt--40 pb--80 pt-md--30 pb-md--60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 order-lg-2 order-1 mb-md--30">
                    <div class="single-post-wrapper">
                        <article class="post post-details mb--30">
                            <div class="post-media">
                                <div class="image"><img src="{{ asset('storage/'.$blog->image) }}" alt="blog"></div>
                            </div>
                            <div class="post-info">
                                <header class="entry-header">
                                    <div class="entry-meta">
                                        <span class="post-date">{{ $blog->created_at }}</span></div>
                                    <h2 class="post-title">{{ $blog->title }}</h2>
                                </header>
                                <div class="post-content">
                                    {!! $blog->content !!}
                                </div>
                                <div class="footer-meta"><a class="comment-count" href="#">0
                                        Comments</a><span>/</span>
                                    <p class="post-tags">Tags: <a href="#">HARDWARE,</a><a
                                            href="#">HIPSTER,</a><a href="#">LIGHT,</a><a href="#">MAC,</a><a
                                            href="#">VIDEO-2</a></p>
                                </div>
                                <div class="social__sharing mb--30">
                                    <h3>SHARE THIS POST</h3>
                                    <ul class="social social-round">
                                        <li class="social__item"><a href="facebook.com" class="social__link"><i
                                                    class="fa fa-facebook"></i></a></li>
                                        <li class="social__item"><a href="twitter.com" class="social__link"><i
                                                    class="fa fa-twitter"></i></a></li>
                                        <li class="social__item"><a href="pinterest.com" class="social__link"><i
                                                    class="fa fa-pinterest"></i></a></li>
                                        <li class="social__item"><a href="google.plus.com"
                                                                    class="social__link"><i class="fa fa-google-plus"></i></a></li>
                                        <li class="social__item"><a href="linkedin.com" class="social__link"><i
                                                    class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
