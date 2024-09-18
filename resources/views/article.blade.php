@php use Illuminate\Support\Facades\Storage;use Illuminate\Support\Facades\URL; @endphp
@extends('layouts.master')
@section('title', $article->title)
@section('description', $article->description)
@section('keywords')
    @foreach($allTags as $tag)
        {{ $tag->translated->first()->title }},
    @endforeach
@endsection
@section('author', $author)
@section('image', asset(Storage::url($mainImage)))
@section('type', 'article')
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
                            <a href="{{ route('home') }}">{{ __('Home')}}</a>
                        </li>
                        <li>
                            <i data-feather="chevron-left"></i>
                        </li>
                        <li>
                            <a href="{{ route('blog.index') }}">
                                {{ __('Blog')}}
                            </a>
                        </li>
                        <li>
                            <i data-feather="chevron-left"></i>
                        </li>
                        <li>
                            <a href="{{ route('blog.category_'. session('locale'), $category->translated->first()->slug) }}">
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
                                            @if(session('locale') === 'en')
                                                By
                                            @endif <a href="#">
                                                {{ $author }}
                                            </a>
                                        </h3>
                                    </div>
                                    @if($article->date)
                                        <div class="items-center blog-date">
                                            <i data-feather="calendar"></i>
                                            <span>
                                            {{ $article->date }}
                                        </span>
                                        </div>
                                    @endif
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
                    <div class="items-center justify-content-between blog-tag-box mt-3">
                        <ul class="blog-tags">
                            @foreach($tags as $tag)
                                <li>
                                    <a href="{{ route('blog.tag_' . session('locale'), $tag->translated->first()->slug) }}">
                                        {{ $tag->translated->first()->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="social-network">
                            <li>
                                <div class="fb-share-button" data-layout="button_count" data-size=""
                                     data-href="{{ URL::current() }}">
                                    <a target="_blank" class="fb-xfbml-parse-ignore"
                                       href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">
                                    </a>
                                </div>
                            </li>
                            <li>
                                <script type="IN/Share" data-url="{{ URL::current() }}"></script>
                            </li>
                            <li>
                                <a href="https://wa.me/?text={{ URL::current() }}">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="right-detail">
                        <div class="right-item">
                            <h3 class="blog-title pb-3">
                                {{ __('Search')}}
                            </h3>
                            <form action="{{ route('blog.search_' . session('locale')) }}">
                                <div class="form-group">
                                    <input type="search" name="search" placeholder="{{ __('Search')}}"
                                           class="form-control custom-form"/>
                                    <button class="btn btn-search" type="submit">
                                        <i data-feather="search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="right-item">
                            <h3 class="blog-title">
                                {{ __('Most Recent Articles')}}
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
                                                    <a href="{{ route('article_' . session('locale'), $article->translated->first()->slug) }}">
                                                        {{ $article->translated->first()->title }}
                                                    </a>
                                                </h4>
                                                @if($article->translated->first()->date)
                                                    <div class="items-center blog-date">
                                                        <i data-feather="calendar"></i>
                                                        <span>
                                                        {{ $article->translated->first()->date }}
                                                    </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="right-item">
                            <h3 class="blog-title">
                                {{ __('Categories')}}
                            </h3>
                            <ul class="category-list">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('blog.category_' . session('locale'), $category->translated->first()->slug) }}">
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
                            <h3 class="blog-title">{{ __('Tags')}}</h3>
                            <ul class="blog-tags mt-4">
                                @foreach($otherTags as $tag)
                                    <li>
                                        <a href="{{ route('blog.tag_' . session('locale'), $tag->translated->first()
                                        ->slug) }}">
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
