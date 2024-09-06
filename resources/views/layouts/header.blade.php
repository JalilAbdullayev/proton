@php use Illuminate\Support\Facades\Storage; @endphp
<header>
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset(Storage::url($settings->logo)) }}" alt="">
                </a>
            </div>
            <nav>
                <ul class="custom-navbar">
                    <li class="nav-item mobile-header">
                        <a href="/" class="logo">
                            <img src="{{ asset(Storage::url($settings->logo)) }}" alt="">
                        </a>
                        <button class="btn btn-close">
                            <i data-feather="x"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}">About us</a>
                    </li>
                    <li class="nav-item">
                        <a href="./portfolio.html">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a href="./blog.html">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="./contact.html">Contact</a>
                    </li>
                    <li>
                        <ul class="contact-list px-4">
                            <li>
                                <a href="mailto:{{ $contact->email }}">
                                    {{ $contact->email }}
                                </a>
                            </li>
                            <li>
                                <a href="tel:{{ preg_replace('/\s+/', '', $contact->phone) }}">
                                    {{ $contact->phone }}
                                </a>
                            </li>
                            <li>
                                <ul class="social-network">
                                    @foreach($socials as $social)
                                        <li>
                                            <a href="{{ $social->url }}">
                                                {!! $social->icon !!}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-search">
                    <i data-feather="search"></i>
                </button>
                <button class="btn btn-nav text-white">
                    <i data-feather="grid"></i>
                </button>
                <a href="{{ $socials->where('title', 'WhatsApp')->first()->url }}"
                   class="d-none d-lg-flex align-items-center gap-2 btn btn-main dark custom-rounded">
                    {!! $socials->where('title', 'WhatsApp')->first()->icon !!}
                    <span>
                        Contact now
                    </span>
                </a>
            </div>
        </div>
    </div>
</header>
