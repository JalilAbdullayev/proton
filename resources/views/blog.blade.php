@php use Illuminate\Support\Facades\Route;use Illuminate\Support\Facades\Storage;use SHTayeb\Bookworm\Bookworm; @endphp
@extends('layouts.master')
@section('title', 'Blog')
@section('content')
    <!-- Breadcrumb start -->
    <section class="breadcrumb">
        <div class="container-fluid">
            <div class="breadcrumb-bg">
                <div class="h-100 row flex-column justify-content-center align-content-center text-center">
                    <h3 class="breadcrumb-title">
                        @if(Route::is('blog.category'))
                            {{ $category->title }}
                        @elseif(Route::is('blog.tag'))
                            {{ $tag->title }}
                        @elseif(Route::is('blog.search') || Route::is('search'))
                            {{ $search }}
                        @else
                            {{ __('Blog')}}
                        @endif</h3>
                    <ul class="breadcrumb-box">
                        <li>
                            <a href="{{ route('home') }}">{{ __('Home')}}</a>
                        </li>
                        @unless(Route::is('blog.index') || Route::is('search'))
                            <li>
                                <i data-feather="chevron-left"></i>
                            </li>
                            <li>
                                <a href="{{ route('blog.index') }}">
                                    {{ __('Blog')}}
                                </a>
                            </li>
                        @endunless
                        @unless(Route::is('search'))
                            <li>
                                <i data-feather="chevron-left"></i>
                            </li>
                            {{ __('Blog')}}
                        @endunless
                        @if(Route::is('blog.category'))
                            <li>
                                <i data-feather="chevron-left"></i>
                            </li>
                            <li>
                                <a href="#">
                                    {{ $category->title }}
                                </a>
                            </li>
                        @elseif(Route::is('blog.tag'))
                            <li>
                                <i data-feather="chevron-left"></i>
                            </li>
                            <li>
                                <a href="#">
                                    {{ $tag->title }}
                                </a>
                            </li>
                        @elseif(Route::is('blog.search') || Route::is('search'))
                            <li>
                                <i data-feather="chevron-left"></i>
                            </li>
                            <li>
                                <a href="#">
                                    {{ $search }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <img src="{{ asset('front/images/bg/breadcrumb.png')}}" class="breadcrumb-img" alt=""/>
            </div>
        </div>
    </section>
    <!-- Breadcrumb end -->
    <!-- Blog start -->
    <section class="blog-section py-5">
        <div class="container">
            <div class="row">
                @foreach($blog as $article)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="blog-card">
                            <div class="blog-img">
                                @unless(Route::is('search_' . session('locale')))
                                    <a href="{{ route('article_' . session('locale'), $article->translated->first()->slug) }}">
                                        <img src="{{ asset(Storage::url('blog/'.$article->image->image)) }}" alt="">
                                    </a>
                                @else
                                    <a href="{{ route('service_' . session('locale'), $article->translated->first()->slug) }}">
                                        <img src="{{ asset(Storage::url($article->image)) }}" alt="">
                                    </a>
                                @endunless
                            </div>
                            <div class="blog-body">
                                @unless(Route::is('search_' . session('locale')))
                                    <div class="auth-head">
                                <span class="auth-name">
                                    @if(session('locale') === 'en')
                                        By
                                    @endif <a href="#!">
                                        {{ $article->author->name }}
                                    </a>
                                </span>
                                        @if($article->translated->first()->full_text)
                                            <span class="time">
                                                @if(session('locale') === 'az')
                                                    {{ (new Bookworm())->estimate($article->translated->first()->full_text, 'dəqiqə') }}
                                                @elseif(session('locale') === 'ru')
                                                    {{ (new Bookworm())->estimate($article->translated->first()->full_text, 'минута') }}
                                                @else
                                                    {{ (new Bookworm())->estimate($article->translated->first()->full_text) }}
                                                    read
                                                @endif
                                    </span>
                                        @endif
                                    </div>
                                @endunless
                                <div class="blog-content">
                                    <h3 class="blog-title">
                                        @unless(Route::is('search_' . session('locale')))
                                            <a href="{{ route('article_' . session('locale'), $article->translated->first()->slug) }}">
                                                {{ $article->translated->first()->title }}
                                            </a>
                                        @else
                                            <a href="{{ route('service_' . session('locale'), $article->translated->first()->slug) }}">
                                                {{ $article->translated->first()->title }}
                                            </a>
                                        @endunless
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $blog->links() }}
        </div>
    </section>
    <!-- Blog end -->
@endsection
