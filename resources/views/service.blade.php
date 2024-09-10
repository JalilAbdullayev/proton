@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.master')
@section('title', $service->title)
@section('description', $service->description)
@section('keywords', $service->keywords)
@section('content')
    <main>
        <!-- Breadcrumb start -->
        <section class="breadcrumb">
            <div class="container-fluid">
                <div class="breadcrumb-bg">
                    <div class="h-100 row flex-column justify-content-center align-content-center text-center">
                        <h3 class="breadcrumb-title">
                            {{ $service->title }}
                        </h3>
                        <ul class="breadcrumb-box">
                            <li>
                                <a href="{{ route('home_' . session('locale')) }}">Home</a>
                            </li>
                            <li>
                                <i data-feather="chevron-left"></i>
                            </li>
                            <li>
                                {{ $service->title }}
                            </li>
                        </ul>
                    </div>
                    <img src="{{ asset('front/images/bg/breadcrumb.png') }}" class="breadcrumb-img" alt=""/>
                </div>
            </div>
        </section>
        <!-- Breadcrumb end -->

        <!-- Service detail start -->
        <section class="service-detail py-5">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12">
                        <div class="section-content pe-0 ">
                            <div class="inner-text">
                                {!! $service->full_text !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-img">
                    <img src="{{ asset(Storage::url($service->image)) }}" alt="" class="mx-auto"/>
                </div>
            </div>
        </section>
        <!-- Service detail end -->

        <!-- Benefit start -->
        <section class="benefit-section">
            <div class="container">
                <div class="section-title-box border-0 text-center">
                    <h4 class="subtitle">
                        Service benefit
                    </h4>
                    <h2 class="section-title py-3">
                        Benefit of our Services
                    </h2>
                </div>
                <div class="row">
                    @foreach($otherServices as $service)
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="service-card">
                                <div class="service-head py-4">
                                    <div class="icon">
                                        <i data-feather="heart"></i>
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
                                        <span>look more</span>
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
        </section>
        <!-- Benefit end -->
    </main>
@endsection
