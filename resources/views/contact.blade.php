@extends('layouts.master')
@section('content')
    <!-- Breadcrumb start -->
    <section class="breadcrumb">
        <div class="container-fluid">
            <div class="breadcrumb-bg">
                <div class="h-100 row flex-column justify-content-center align-content-center text-center">
                    <h3 class="breadcrumb-title">Contact</h3>
                    <ul class="breadcrumb-box">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <i data-feather="chevron-left"></i>
                        </li>
                        <li>
                            contact
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
                        <h3 class="blog-title">Call us on</h3>
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
                        <h3 class="blog-title">Email us</h3>
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
                        <h3 class="blog-title">our location</h3>
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
                                Contact us
                            </h4>
                            <h2 class="section-title">
                                Connect with Us for Assistance
                            </h2>
                        </div>
                        <p class="inner-text">
                            Lorem ipsum dolor sit amet consecadipiscing elit Ut et massa Aliquam in hendrerit urna.
                        </p>
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
                                            <input type="text" id="name" name="name" placeholder="Name"
                                                   class="form-control custom-form"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="name">
                                            <input type="email" id="name" placeholder="Email" name="email"
                                                   class="form-control custom-form"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="name">
                                            <input type="tel" id="name" placeholder="Phone" name="phone"
                                                   class="form-control custom-form"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="service">
                                            <select id="service" name="subject" class="form-control custom-form">
                                                <option value="all">Select Service</option>
                                                <option value="art&desgin">Art and design</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="message">
                                            <textarea name="message" id="message" placeholder="Write a message"
                                                      class="form-control custom-form" rows="5"></textarea>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <button class="btn btn-main">send now</button>
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
