@extends('layouts.master')
@section('title', 'Contact')
@section('content')
    <!-- Breadcrumb start -->
    <section class="breadcrumb">
        <div class="container-fluid">
            <div class="breadcrumb-bg">
                <div class="h-100 row flex-column justify-content-center align-content-center text-center">
                    <h3 class="breadcrumb-title">{{ __('Contact us')}}</h3>
                    <ul class="breadcrumb-box">
                        <li>
                            <a href="{{ route('home') }}">{{ __('Home')}}</a>
                        </li>
                        <li>
                            <i data-feather="chevron-left"></i>
                        </li>
                        <li>
                            {{ __('Contact us')}}
                        </li>
                    </ul>
                </div>
                <img src="{{ asset('front/images/bg/breadcrumb.png')}}" class="breadcrumb-img" alt="">
            </div>
        </div>
    </section>
    <!-- Breadcrumb end -->

    <section class="contact-us-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="contact-card text-center">
                        <div class="icon mx-auto mb-3">
                            <i data-feather="phone-call"></i>
                        </div>
                        <h3 class="blog-title">{{ __('Phone')}}</h3>
                        <ul class="phone-list">
                            <li>
                                <a href="tel:{{ preg_replace('/\s+/', '', $contact->phone) }}">
                                    {{ $contact->phone }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="contact-card text-center">
                        <div class="icon mx-auto mb-3">
                            <i data-feather="mail"></i>
                        </div>
                        <h3 class="blog-title">{{ __('Email')}}</h3>
                        <ul class="phone-list">
                            <li>
                                <a href="mailto:{{ $contact->email }}">
                                    {{ $contact->email }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="contact-card text-center">
                        <div class="icon mx-auto mb-3">
                            <i data-feather="map-pin"></i>
                        </div>
                        <h3 class="blog-title">{{ __('Location')}}</h3>
                        <ul class="phone-list">
                            <li>
                                {{ $contact->translated->first()->address }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-form-section pt-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-lg-5">
                    <div class="section-content">
                        <div class="section-title-box pb-0 border-0">
                            <h4 class="subtitle">
                                {{ $contact->translated->first()->subtitle }}
                            </h4>
                            <h2 class="section-title">
                                {{ $contact->translated->first()->title }}
                            </h2>
                        </div>
                        <div class="inner-text">
                            {!! $contact->translated->first()->description !!}
                        </div>
                        <ul class="social-network pt-3">
                            @foreach($socials as $social)
                                <li>
                                    <a href="{{ $social->url }}">
                                        {!! $social->icon !!}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <form action="{{ route('send') }}" method="POST">
                        @csrf
                        <div class="contact-form my-5 my-lg-0">
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

            <div class="map-box my-5">
                {!! $contact->map !!}
            </div>
        </div>
    </section>
@endsection
