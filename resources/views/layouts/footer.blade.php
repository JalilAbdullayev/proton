@php use Illuminate\Support\Facades\Storage; @endphp
<footer class="pt-5 mt-5">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-custom-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="footer-left">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset(Storage::url($settings->logo)) }}" alt=""/>
                        </a>
                    </div>

                    <p class="inner-text py-4">
                        {{ $settings->translated->first()->description }}
                    </p>
                    <ul class="social-network footer">
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
            <div class="col-12 col-custom-md-6 col-lg-2 mb-4 mb-lg-0">
                <h5 class="small-title mb-3">
                    {{ __('Services')}}
                </h5>
                <ul class="footer-menu">
                    @foreach($services as $service)
                        <li>
                            <a href="{{ route('service_' . session('locale'), $service->translated->first()->slug) }}">
                                {{ $service->translated->first()->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-custom-md-6 col-lg-2 mb-4 mb-lg-0">
                <h5 class="small-title mb-3">
                    {{ __('Navigation')}}
                </h5>
                <ul class="footer-menu">
                    <li>
                        <a href="{{ route('home') }}">
                            {{ __('Home')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about_' . session('locale')) }}">
                            {{ __('About us')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('portfolio.index') }}">
                            {{ __('Portfolio')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}">
                            {{ __('Blog')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact_' . session('locale')) }}">
                            {{ __('Contact us')}}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-custom-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="footer-right">
                    <h5 class="small-title">Newsletter</h5>
                    <p class="inner-text">
                        Our team do comprises professional with experience.
                    </p>
                    <a href="mailto:{{ $contact->email }}" class="footer-mail">
                        <i data-feather="mail"></i>
                        <span>
                            {{ $contact->email }}
                        </span>
                    </a>
                    <form action="">
                        <div class="subscribe-form">
                            <div class="form-group">
                                <input type="email" placeholder="Email address" class="form-control custom-form ">
                                <button class="btn btn-main">
                                    <i data-feather="send"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="copyright text-center pt-5 pb-4">
            © <a href="{{ route('home') }}">
                {{ $settings->translated->first()->title }}
            </a> 2019 - {{ date('Y') }} {{ __('All Rights Reserved.')}}
        </div>
    </div>
</footer>
