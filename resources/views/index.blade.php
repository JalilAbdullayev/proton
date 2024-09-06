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
                        <h4 class="subtitle">
                            day-to-day operations
                        </h4>
                        <h2 class="section-title">
                            Empowering excellence
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
                                    <div class="icon">
                                        <svg width="47" height="47" viewBox="0 0 47 47" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_268_177)">
                                                <path
                                                    d="M12.3537 24.6735C10.3043 23.8439 8.35248 23.0632 6.40068 22.2581C4.08291 21.3066 3.64375 19.3304 5.37598 17.5738C7.03501 15.8903 8.71844 14.2557 10.3775 12.5723C11.1826 11.7428 12.0853 11.45 13.232 11.6208C14.6714 11.8403 16.1353 12.0111 17.5991 12.0843C18.0139 12.1087 18.5263 11.8891 18.819 11.5964C20.1853 10.2545 21.5271 8.91264 22.8202 7.49758C26.8702 3.00844 32.1157 1.15422 37.9467 0.544285C39.5081 0.373502 41.1184 0.324707 42.6798 0.324707C45.144 0.349105 46.681 1.76416 46.5346 4.17952C46.3638 7.27801 46.1199 10.4253 45.5099 13.475C44.7292 17.403 42.8018 20.843 39.8253 23.6244C38.3127 25.0394 36.8 26.4789 35.385 27.9671C35.0434 28.3331 34.8238 28.9918 34.8238 29.5042C34.8726 30.9192 35.2386 32.3343 35.2142 33.7493C35.1898 34.652 34.9214 35.7255 34.3603 36.3843C32.7256 38.2385 30.9202 39.9463 29.1392 41.6785C27.5777 43.1668 25.5527 42.7276 24.6988 40.727C23.9913 39.0436 23.2838 37.3602 22.6982 35.6279C22.3811 34.6764 21.8931 34.5057 20.9904 34.6764C18.8678 35.0912 16.7452 35.4084 14.6226 35.7743C12.0365 36.2379 10.6702 34.8472 11.1094 32.2367C11.5486 29.7481 11.9389 27.284 12.3537 24.6735ZM27.2362 39.9463C28.944 38.2141 30.4566 36.6282 32.0425 35.1156C32.628 34.5545 32.7256 34.0177 32.628 33.2858C32.4085 31.6024 32.1889 29.8945 32.0425 28.2111C32.0181 27.8207 32.2377 27.284 32.5304 26.9912C34.409 25.137 36.3365 23.3316 38.2395 21.5018C40.1669 19.672 41.5087 17.4762 42.387 14.9876C43.6069 11.4988 44.0217 7.88794 43.9485 4.20392C43.9241 3.25241 43.4849 2.88645 42.5822 2.93524C40.8744 3.03283 39.1666 3.00844 37.4831 3.22801C33.2136 3.76476 29.188 4.96024 26.0163 8.05873C23.9425 10.0349 22.0151 12.2063 19.9657 14.2557C19.6241 14.5973 19.0142 14.8656 18.5506 14.8168C16.8184 14.6949 15.0862 14.4265 13.354 14.2557C12.988 14.2313 12.4757 14.2557 12.2317 14.4753C10.4751 16.1343 8.74284 17.8665 6.91302 19.672C8.81603 20.4283 10.4995 21.1114 12.1829 21.7945C14.891 22.8924 15.2326 23.5512 14.7202 26.4301C14.3299 28.6503 13.9883 30.8948 13.5979 33.2126C14.0127 33.1882 14.2811 33.1882 14.5495 33.1638C16.672 32.7978 18.7946 32.4563 20.9172 32.0903C23.1618 31.6999 24.0401 32.1635 24.894 34.2617C25.6503 36.0427 26.3823 37.8969 27.2362 39.9463Z"
                                                    fill="#fff" stroke="currentColor" stroke-width="0.486667">
                                                </path>
                                                <path
                                                    d="M14.3546 46.5335C14.0374 46.2895 13.5494 46.0944 13.4274 45.7772C13.2811 45.3868 13.2567 44.7037 13.4762 44.4597C15.3792 42.4591 17.3067 40.5073 19.3316 38.6531C19.6 38.4091 20.6003 38.5311 20.8931 38.8483C21.1859 39.1655 21.2591 40.1414 20.9907 40.4341C19.1609 42.4347 17.2091 44.3133 15.2573 46.2164C15.0865 46.3383 14.7449 46.3627 14.3546 46.5335Z"
                                                    fill="#fff" stroke="currentColor" stroke-width="0.486667">
                                                </path>
                                                <path
                                                    d="M8.62068 26.6742C8.30351 27.1621 8.13273 27.5769 7.83996 27.8941C6.15653 29.6019 4.4731 31.2853 2.76527 32.9687C2.13094 33.6031 1.44781 33.8471 0.740278 33.1883C0.0327498 32.5296 0.22793 31.7977 0.862266 31.1633C2.61889 29.4067 4.32672 27.6257 6.13213 25.9423C6.4737 25.6251 7.18123 25.5275 7.64478 25.6251C8.01074 25.7227 8.25472 26.2838 8.62068 26.6742Z"
                                                    fill="#fff" stroke="currentColor" stroke-width="0.486667">
                                                </path>
                                                <path
                                                    d="M9.79155 35.5791C11.0358 35.6767 11.6214 36.8478 10.8894 37.6529C9.03523 39.6291 7.10782 41.5321 5.10723 43.3863C4.83885 43.6547 3.76536 43.5571 3.54578 43.2643C3.25301 42.874 3.17982 41.8981 3.44819 41.5809C5.25361 39.6047 7.18102 37.7505 9.08402 35.8963C9.3036 35.6767 9.66957 35.6279 9.79155 35.5791Z"
                                                    fill="#fff" stroke="currentColor" stroke-width="0.486667">
                                                </path>
                                                <path
                                                    d="M39.2637 12.8404C39.2393 15.6949 36.8971 18.0371 34.0426 18.0127C31.2125 17.9883 28.8459 15.6217 28.8459 12.7916C28.8459 9.91272 31.2613 7.52176 34.1402 7.57056C37.0191 7.64375 39.2881 9.98591 39.2637 12.8404ZM36.6532 12.816C36.6776 11.3766 35.6041 10.2543 34.1646 10.2299C32.7008 10.1811 31.5053 11.3278 31.4809 12.7672C31.4565 14.2067 32.6764 15.4022 34.1158 15.3778C35.5309 15.3534 36.6288 14.2555 36.6532 12.816Z"
                                                    fill="#fff"></path>
                                                <path
                                                    d="M27.6749 30.1871C27.3822 30.5043 27.1138 31.0166 26.7478 31.1142C26.3087 31.2118 25.7231 31.041 25.3328 30.797C25.04 30.6018 24.918 30.1383 24.7472 29.7723C23.137 26.2835 20.5997 23.7217 17.0864 22.1359C16.8912 22.0139 16.6472 21.9407 16.4521 21.8187C15.7689 21.4284 15.403 20.8672 15.7445 20.1109C16.0861 19.3058 16.7204 19.135 17.55 19.4766C20.3313 20.6233 22.7954 22.2579 24.6252 24.6732C25.6499 26.0151 26.4063 27.5522 27.2846 29.016C27.431 29.3088 27.5042 29.6747 27.6749 30.1871Z"
                                                    fill="#fff" stroke="currentColor" stroke-width="0.486667">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
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
                                    <a href="{{ route('service', $service->translated->first()->slug) }}">
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
                            our projects
                        </h4>
                        <h2 class="section-title">
                            Unlocking Potential Explore Our Projects
                        </h2>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="d-flex mt-3">
                            <a href="./projects.html" class="btn btn-main dark ms-auto">
                                more projects
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
                                <a href="./portfolio-detail.html">
                                    <img src="{{ asset(Storage::url('portfolio/'.$project->image->image)) }}" alt="">
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="./portfolio-detail.html" class="project-title">
                                    <h3>
                                        {{ $project->translated->first()->title }}
                                    </h3>
                                    <i data-feather="arrow-up-right"></i>
                                </a>
                                <div class="project-prices">
                                    <span class="price new-price">$ 65.00 USD</span>
                                    <span class="price old-price">$ 85.00 USD</span>
                                </div>
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
                            why choos us
                        </h4>
                        <h2 class="section-title">
                            Elevate Your IT Experience with Our Expertise
                        </h2>
                    </div>
                    <ul class="preferences-list">
                        <li>
                            <div class="icon">
                                <i data-feather="award" style="color: #fff"></i>
                            </div>
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
                        <li>
                            <div class="icon">
                                <i data-feather="award" style="color: #fff"></i>
                            </div>
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
                        <li>
                            <a href="#" class="btn btn-main">learn more</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="section-img">
                        <img src="./assets/images/preferences/preferences-01.png" alt="">
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
                    MEET OUR TRUSTED CLIENTS
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
                        <img src="./assets/images/preferences/preferences-02.png" alt="">
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
                    <a href="#" class="btn btn-main dark ms-lg-3">
                        learn more
                    </a>
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
                            our teams
                        </h4>
                        <h2 class="section-title">
                            Dedicated Experts Crafting Your IT Solutions
                        </h2>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="d-flex flex-end">
                            <a href="./about.html#teams" class="btn btn-main dark ms-auto">view more</a>
                        </div>
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
                            our blog
                        </h4>
                        <h2 class="section-title">
                            Tech Insights & Innovations: Explore Our Blog
                        </h2>
                    </div>
                </div>
            </div>
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
                                            <input type="text" id="name" name="name" placeholder="Name" required
                                                   class="form-control custom-form">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="email">
                                            <input type="email" id="email" name="email" placeholder="E-mail"
                                                   class="form-control custom-form"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="phone">
                                            <input type="tel" id="phone" name="phone" placeholder="Phone" required
                                                   class="form-control custom-form"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="subject">
                                            <select id="subject" name="subject" class="form-control custom-form">
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
                                                      class="form-control custom-form" rows="5" required></textarea>
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
        </div>
    </section>
    <!--Home contact end -->
@endsection
