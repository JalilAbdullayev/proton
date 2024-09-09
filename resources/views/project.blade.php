@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.master')
@section('content')
    <main>
        <!-- Breadcrumb start -->
        <section class="breadcrumb">
            <div class="container-fluid">
                <div class="breadcrumb-bg">
                    <div class="h-100 row flex-column justify-content-center align-content-center text-center">
                        <h3 class="breadcrumb-title">
                            {{ $project->title }}
                        </h3>
                        <ul class="breadcrumb-box">
                            <li>
                                <a href="/">Home</a>
                            </li>
                            <li>
                                <i data-feather="chevron-left"></i>
                            </li>
                            <li>
                                <a href="{{ route('portfolio') }}">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <i data-feather="chevron-left"></i>
                            </li>
                            <li>
                                {{ $project->title }}
                            </li>
                        </ul>
                    </div>
                    <img src="{{ asset('front/images/bg/breadcrumb.png') }}" class="breadcrumb-img" alt="">
                </div>
            </div>
        </section>
        <!-- Breadcrumb end -->

        <!-- Portfolio detail start -->
        <section class="portfolio-detail-section py-5">
            <div class="container">
                <div class="detail-head py-3">
                    <div class="row justify-content-between">
                        <div class="col-12">
                            <div class="section-content pe-0 ">
                                <div class="inner-text">
                                    {{ $project->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail-body">
                    <ul class="portfolio-info">
                        <li>
                            <h5 class="title">
                                Categories:
                            </h5>
                            <p class="inner-text">
                                {{ $category->translated->first()->title }}
                            </p>
                        </li>
                        <li>
                            <h5 class="title">
                                Location:
                            </h5>
                            <p class="inner-text">
                                {{ $project->location }}
                            </p>
                        </li>
                        <li>
                            <h5 class="title">
                                Date:
                            </h5>
                            <p class="inner-text">
                                {{ $project->date }}
                            </p>
                        </li>
                        <li>
                            <h5 class="title">
                                Status:
                            </h5>
                            <p class="inner-text">
                                {{ $status }}
                            </p>
                        </li>
                        <li>
                            <h5 class="title">
                                Duration:
                            </h5>
                            <p class="inner-text">
                                {{ $project->duration }}
                            </p>
                        </li>
                    </ul>
                    <div class="detail-img my-5">
                        <img src="{{ asset(Storage::url($mainImage)) }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio detail end -->

        <!-- Services start -->
        <section class="services-section mb-5">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12">
                        <div class="content-body pb-2">
                            <div class="inner-text">
                                {!! $project->full_text !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="images-box py-5">
                    <div class="image-item">
                        <a href="{{ asset(Storage::url($mainImage)) }}" data-fancybox="gallery" data-caption="{{$project->title}}">
                            <img src="{{ asset(Storage::url($mainImage)) }}" alt="{{ $project->title }}">
                        </a>
                    </div>
                    <div class="image-item">
                        <a href="{{ asset(Storage::url($mainImage)) }}" data-fancybox="gallery">
                            <img src="{{ asset(Storage::url($mainImage)) }}" alt="">
                        </a>
                        <a href="#" class="btn btn-play">
                            <i data-feather="play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services end -->
    </main>
@endsection
