@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.master')
@section('content')
    <!-- Banner  start-->
    <section class="banner-section">
        <div class="banner-bg">
            <div class="overlay"></div>
            <div class="container h-100">
                <div class="h-100 row align-items-center justify-content-center position-relative z-1">
                    <div class="col-12 col-lg-7">
                        <h1 class="banner-title">
                            {{ $banner->translated->first()->title }}
                        </h1>
                        <div class="inner-text">
                            {!! $banner->translated->first()->subtitle !!}
                        </div>
                        <form>
                            <div class="search-form">
                                <div class="form-group mb-0 mb-lg-3">
                                    <input type="text" id="searchInput" placeholder="Your email address"
                                           class="form-control custom-form">
                                </div>
                                <button class="btn btn-main dark">
                                    <i data-feather="send"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner end -->

    <!-- Services start -->
    <section class="position-relative home-services-section py-5">
        <div class="container">
            <div class="section-title-box">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-7 mb-5 mb-lg-0">
                        <h2 class="section-title">
                            {{ __("Empowering excellence")}}
                        </h2>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="swiper-buttons">
                            <button class="btn swiper-button-prev">
                            </button>
                            <button class="btn swiper-button-next">
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper servicesSwiper">
                <div class="swiper-wrapper">
                    @foreach($services as $index => $service)
                        <div class="swiper-slide">
                            <div class="service-card">
                                <div class="service-head py-4">
                                    <div class="count">
                                        0{{ $index + 1 }}
                                    </div>
                                </div>
                                <div class="service-body">
                                    <h3 class="service-title">
                                        {{ $service->translated->first()->title }}
                                    </h3>
                                    <p class="inner-text">
                                        {{ $service->translated->first()->description }}
                                    </p>
                                    <a href="{{ route('service_' . session('locale'), $service->translated->first()->slug) }}">
                                        <span>{{ __("look more")}}</span>
                                        <span>
                                        <i data-feather="arrow-up-right"></i>
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Services end -->

    <!-- Projects start -->
    <section class="home-projects py-5">
        <div class="container">
            <div class="section-title-box">
                <div class="row align-items-center justify-content-between">
                    <div class="col-12 col-lg-6">
                        <h4 class="subtitle">
                            {{ __("our projects")}}
                        </h4>
                        <h2 class="section-title">
                            {{ __("Unlock Your Potential with Our Projects")}}
                        </h2>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="d-flex mt-3">
                            <a href="{{ route('portfolio.index') }}" class="btn btn-main dark ms-auto">
                                {{ __("More Projects")}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper homeProjectsSwiper">
            <div class="swiper-wrapper">
                @foreach($portfolio as $project)
                    <div class="swiper-slide">
                        <div class="project-card">
                            <div class="project-img">
                                <a href="{{ route('project_' . session('locale'), $project->translated->first()->slug) }}">
                                    <img src="{{ asset(Storage::url('portfolio/'.$project->image->image)) }}" alt="">
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('project_' . session('locale'), $project->translated->first()->slug) }}"
                                   class="project-title">
                                    <h3>
                                        {{ $project->translated->first()->title }}
                                    </h3>
                                    <i data-feather="arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-buttons">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
    <!-- Projects end -->

    <!-- Preferences start -->
    <section class="home-preferences pt-0 pb-5 pt-lg-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="section-title-box">
                        <h4 class="subtitle">
                            why choose us
                        </h4>
                        <h2 class="section-title">
                            Elevate Your IT Experience with Our Expertise
                        </h2>
                    </div>
                    <ul class="preferences-list">
                        <li>
                            <div class="content">
                                <h3 class="title">
                                    Software business
                                </h3>
                                <p class="inner-text">
                                    Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi adipiscing
                                    elit ololpe.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="section-img">
                        <img src="{{ asset('front/images/preferences/preferences-01.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Preferences end -->

    <!-- Partners start -->
    <section class="home_partners py-0 py-lg-5">
        <div class="container">
            <div class="section-title-box border-0 text-center">
                <h4 class="subtitle mx-auto">
                    {{ __('MEET OUR CLIENTS')}}
                </h4>
            </div>
            <div class="swiper partnersSwiper">
                <div class="swiper-wrapper">
                    @foreach($clients as $client)
                        <div class="swiper-slide">
                            <div class="partner-item">
                                <a href="{{ $client->url }}">
                                    <img src="{{ asset(Storage::url($client->image)) }}" alt="" class="img-fluid"/>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Partners end -->

    <!-- Preferences 2 start -->
    <section class="preferences-section-2 py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 mb-5">
                    <div class="section-img">
                        <img src="{{ asset('front/images/preferences/preferences-02.png')}}" alt="">
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-5">
                    <div class="section-title-box border-0 ms-lg-3">
                        <h4 class="subtitle">
                            why choose us
                        </h4>
                        <h2 class="section-title">
                            Learn More About Our More Service & Solution
                        </h2>
                    </div>
                    <p class="inner-text ms-lg-3">
                        We provide professional services to clients in a particular area of expertise. We have a team of
                        experts in various
                        fields who can offer advice on a project particular.
                    </p>
                    <div class="successful-projects ms-lg-3 mb-5">
                        <div class="project-item">
                            <span class="count">600+</span>
                            <p class="inner-text">
                                Successful Projects Lorem ipsum dolor amet.
                            </p>
                        </div>
                        <div class="project-item">
                            <span class="count">600+</span>
                            <p class="inner-text">
                                Successful Projects Lorem ipsum dolor amet.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Preferences 2 end -->

    <!-- Teams start -->
    <section class="home_teams_section py-5">
        <div class="container">
            <div class="section-title-box">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 mb-3">
                        <h4 class="subtitle">
                            {{ __('our team')}}
                        </h4>
                        <h2 class="section-title">
                            {{ __('Dedicated Experts Crafting Your IT Solutions')}}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                @foreach($team as $member)
                    <div class="col-12 col-custom-md-6 col-lg-3">
                        <div class="team-card mb-3 mb-lg-0">
                            <div class="team-img">
                                <img src="{{ asset(Storage::url($member->image)) }}" alt="Team member 1">
                            </div>
                            <div class="team-body">
                                <h3 class="title">
                                    {{ $member->translated->first()->name }}
                                </h3>
                                <p class="inner-text">
                                    {{ $member->translated->first()->position }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Teams end -->

    <!-- Blog start -->
    <section class="home_blog_section py-0 py-lg-5">
        <div class="container">
            <div class="section-title-box mb-5">
                <div class="row justify-content-center text-center">
                    <div class="col-12 col-lg-6">
                        <h4 class="subtitle">
                            {{ __("our blog")}}
                        </h4>
                        <h2 class="section-title">
                            {{ __("Tech Insights & Innovations: Explore Our Blog")}}
                        </h2>
                    </div>
                </div>
            </div>
            @foreach($blog as $article)
                <div class="card mb-3 home_blog_item">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <img src="{{ asset(Storage::url('blog/'.$article->image->image)) }}"
                                 class="img-fluid rounded-start" alt=""/>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="{{ route('blog.category_' . session('locale'), $article->category->translated->first()->slug) }}"
                                   class="blog_category">
                                    {{ $article->category->translated->first()->title }}
                                </a>
                                <h5 class="card-title mt-2 mb-3">
                                    <a href="{{ route('article_' . session('locale'), $article->translated->first()->slug) }}">
                                        {{ $article->translated->first()->title }}
                                    </a>
                                </h5>
                                <div class="blog-auth">
                                    <span class="d-inline-block mx-2">By</span>
                                    <div class="auth-title">
                                        <a href="#!">
                                            {{ $article->author->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Blog end -->

    <!-- Home contact start -->
    <section class="home_contact py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-5">
                    <div class="section-title-box border-0">
                        <h3 class="section-title">
                            Get Stared with Us.
                            Call Us Now!
                        </h3>
                    </div>
                    <p class="inner-text">
                        The fastest way to convert visitors into leads and sales on your website is with Social Daily
                        Marketing. That's why
                        businesses use Daily.
                    </p>
                    <div class="d-flex align-items-center contact-info">
                        <div class="icon">
                            <i data-feather="headphones"></i>
                        </div>
                        <div class="info">
                            <p class="inner-text">
                                Toll Free Call.
                            </p>
                            <a href="tel:{{ preg_replace('/\s+/', '', $contact->phone) }}">
                                {{ $contact->phone }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <form action="{{ route('send') }}" method="POST">
                        @csrf
                        <div class="contact-form">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="name">
                                            <input type="text" id="name" name="name" placeholder="{{ __('Name')}}"
                                                   required
                                                   class="form-control custom-form"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="email">
                                            <input type="email" id="email" name="email" placeholder="{{ __('E-mail')}}"
                                                   class="form-control custom-form"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="phone">
                                            <input type="tel" id="phone" name="phone" placeholder="{{ __('Phone')}}"
                                                   required class="form-control custom-form"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="subject">
                                            <input type="text" id="subject" name="subject"
                                                   placeholder="{{ __('Subject')}}" required
                                                   class="form-control custom-form"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="message">
                                            <textarea name="message" id="message" placeholder="{{ __('Message')}}"
                                                      class="form-control custom-form" rows="5" required></textarea>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <button class="btn btn-main">{{ __('send now')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--Home contact end -->
@endsection
