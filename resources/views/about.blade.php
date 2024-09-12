@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.master')
@section('title', 'About')
@section('content')
    <!-- Breadcrumb start -->
    <section class="breadcrumb">
        <div class="container-fluid">
            <div class="breadcrumb-bg">
                <div class="h-100 row flex-column justify-content-center align-content-center text-center">
                    <h3 class="breadcrumb-title">{{ __("About us")}}</h3>
                    <ul class="breadcrumb-box">
                        <li>
                            <a href="{{ route('home_' . session('locale')) }}">{{ __('Home')}}</a>
                        </li>
                        <li>
                            <i data-feather="chevron-left"></i>
                        </li>
                        <li>
                            {{ __("About us")}}
                        </li>
                    </ul>
                </div>
                <img src="{{ asset('front/images/bg/breadcrumb.png')}}" class="breadcrumb-img" alt="">
            </div>
        </div>
    </section>
    <!-- Breadcrumb end -->

    <!-- Our story start -->
    <section class="our-story">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="section-img">
                        <img src="{{ asset(Storage::url($about->image)) }}" alt="">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="section-content">
                        <div class="section-title-box border-0">
                            <h4 class="subtitle">
                                {{ $about->translated->first()->subtitle }}
                            </h4>
                            <h2 class="section-title">
                                {{ $about->translated->first()->title }}
                            </h2>
                        </div>
                        <div class="content-body">
                            <div class="inner-text">
                                {!! $about->translated->first()->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our story end -->

    <!-- Services start -->
    <section class="services-section py-5">
        <div class="container text-center">
            <div class="section-title-box text-center border-0">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-7 mb-5 mx-auto mb-lg-0">
                        <h4 class="subtitle">
                            {{ $home->translated->first()->services_subtitle }}
                        </h4>
                        <h2 class="section-title">
                            {{ $home->translated->first()->services_title }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="services-wrapper mb-5">
                <div class="row">
                    @foreach($services as $index => $service)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="service-card">
                                <div class="service-head py-4">
                                    @if($service->icon)
                                        <div class="icon">
                                            {!! $service->icon !!}
                                        </div>
                                    @endif
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

    <!-- Teams start -->
    <section class="teams-section py-5" id="teams">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="section-title-box border-0">
                        <h4 class="subtitle">
                            {{ $home->translated->first()->team_subtitle }}
                        </h4>
                        <h2 class="section-title">
                            {{ $home->translated->first()->team_title }}
                        </h2>
                        <div class="inner-text">
                            {!! $home->translated->first()->team_description !!}
                        </div>
                    </div>
                    <div class="swiper-buttons">
                        <button class="btn swiper-button-prev">
                        </button>
                        <button class="btn swiper-button-next">
                        </button>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="swiper teamsSwiper">
                        <div class="swiper-wrapper">
                            @foreach($team as $member)
                                <div class="swiper-slide">
                                    <div class="team-card main-card">
                                        <div class="team-img">
                                            <img src="{{ asset(Storage::url($member->image)) }}" alt=""/>
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
                </div>
            </div>
        </div>
    </section>
    <!-- Teams end -->

    <!-- Partners start -->
    <section class="home_partners py-5">
        <div class="container">
            <div class="section-title-box border-0 text-center">
                <h4 class="subtitle mx-auto">
                    {{ $home->translated->first()->clients_title }}
                </h4>
            </div>
            <div class="swiper partnersSwiper">
                <div class="swiper-wrapper">
                    @foreach($clients as $client)
                        <div class="swiper-slide">
                            <div class="partner-item">
                                <a href="{{ $client->url }}">
                                    <img src="{{ asset(Storage::url($client->image)) }}" alt="{{ $client->name }}"/>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Partners end -->
@endsection
