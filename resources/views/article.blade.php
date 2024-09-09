@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.master')
@section('title', $article->title)
@section('content')
    <!-- Breadcrumb start -->
    <section class="breadcrumb">
        <div class="container-fluid">
            <div class="breadcrumb-bg">
                <div class="h-100 row flex-column justify-content-center align-content-center text-center">
                    <h3 class="breadcrumb-title">
                        {{ $article->title }}
                    </h3>
                    <ul class="breadcrumb-box">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <i data-feather="chevron-left"></i>
                        </li>
                        <li>
                            <a href="{{ route('blog.index') }}">
                                Blog
                            </a>
                        </li>
                        <li>
                            <i data-feather="chevron-left"></i>
                        </li>
                        <li>
                            <a href="{{ route('blog.category', $category->translated->first()->slug) }}">
                                {{  $category->translated->first()->title }}
                            </a>
                        </li>
                        <li>
                            <i data-feather="chevron-left"></i>
                        </li>
                        <li>
                            {{ $article->title }}
                        </li>
                    </ul>
                </div>
                <img src="{{ asset('front/images/bg/breadcrumb.png') }}" class="breadcrumb-img" alt=""/>
            </div>
        </div>
    </section>
    <!-- Breadcrumb end -->
    <section class="blog-detail-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="blog-detail">
                        <div class="blog-img">
                            <img src="{{ asset(Storage::url($mainImage)) }}" alt="">
                        </div>
                        <div class="blog-content">
                            <div class="blog-head">
                                <h3 class="blog-title">
                                    {{ $article->title }}
                                </h3>
                                <div class="items-center blog-info py-3">
                                    <div class="items-center auth-info">
                                        <h3 class="auth-name">
                                            By <a href="#">
                                                {{ $author }}
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="items-center blog-date">
                                        <i data-feather="calendar"></i>
                                        <span>
                                            {{ $article->date }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-body">
                            <div class="inner-text">
                                {!! $article->full_text !!}
                            </div>
                            <div class="images-box py-5 d-flex justify-content-center align-items-center">
                                @foreach($images as $image)
                                    <div class="image-item w-25">
                                        <a href="{{ asset(Storage::url('blog/'.$image->image)) }}"
                                           data-fancybox="gallery">
                                            <img src="{{ asset(Storage::url('blog/'.$image->image)) }}" alt=""/>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="items-center justify-content-between blog-tag-box">
                        <ul class="blog-tags">
                            @foreach($tags as $tag)
                                <li>
                                    <a href="{{ route('blog.tag', $tag->translated->first()->slug) }}">
                                        {{ $tag->translated->first()->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="social-network">
                            <li>
                                <a href="">
                                    <i data-feather="facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i data-feather="twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i data-feather="linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i data-feather="youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="right-detail">
                        <div class="right-item">
                            <h3 class="blog-title pb-3">
                                Search here
                            </h3>
                            <form action="{{ route('blog.search') }}">
                                <div class="form-group">
                                    <input type="search" name="search" placeholder="Search here"
                                           class="form-control custom-form"/>
                                    <button class="btn btn-search" type="submit">
                                        <i data-feather="search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="right-item">
                            <h3 class="blog-title">
                                Popular Post
                            </h3>
                            <ul class="popular-blog-list">
                                @foreach($articles as $article)
                                    <li>
                                        <div class="items-center popular-item">
                                            <div class="item-img">
                                                <img src="{{ asset(Storage::url('blog/'.$article->image->image)) }}"
                                                     alt=""/>
                                            </div>
                                            <div class="item-body">
                                                <h4 class="item-title">
                                                    <a href="{{ route('article', $article->translated->first()->slug) }}">
                                                        {{ $article->translated->first()->title }}
                                                    </a>
                                                </h4>
                                                <div class="items-center blog-date">
                                                    <i data-feather="calendar"></i>
                                                    <span>
                                                        {{ $article->translated->first()->date }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="right-item">
                            <h3 class="blog-title">
                                Categories
                            </h3>
                            <ul class="category-list">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('blog.category', $category->translated->first()->slug) }}">
                                        <span class="categpry-title">
                                            {{ $category->translated->first()->title }}
                                        </span>
                                            <span class="count">({{ $category->articles->count() }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="right-item">
                            <h3 class="blog-title">Popular Tags</h3>
                            <ul class="blog-tags mt-4">
                                @foreach($otherTags as $tag)
                                    <li>
                                        <a href="{{ route('blog.tag', $tag->translated->first()->slug) }}">
                                            {{ $tag->translated->first()->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
