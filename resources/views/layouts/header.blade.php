@php use Illuminate\Support\Facades\Storage; @endphp
<header>
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset(Storage::url($settings->logo)) }}" alt="">
                </a>
            </div>
            <nav>
                <ul class="custom-navbar">
                    <li class="nav-item mobile-header">
                        <a href="{{ route('home') }}" class="logo">
                            <img src="{{ asset(Storage::url($settings->logo)) }}" alt="">
                        </a>
                        <button class="btn btn-close">
                            <i data-feather="x"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}">{{ __('Home')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about_' .session('locale')) }}">{{ __('About us')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('portfolio.index') }}">{{ __('Portfolio')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('blog.index') }}">{{ __('Blog')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contact_'. session('locale')) }}">{{ __('Contact us')}}</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}">{{ __('Admin panel')}}</a>
                        </li>
                    @endauth
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
            <div class="d-flex align-items-center right-nav">
                <button class="btn btn-search">
                    <i data-feather="search"></i>
                </button>
                <ul class="lang-select" id="locale">
                    <li class="active-lang text-uppercase">{{session('locale')}}</li>
                    <li class="lang-items">
                        <ul class="lang-box">
                            @unless(session('locale') === 'az')
                                <li>
                                    <a href="{{ url($lang['az']) }}" class="btn btn-lang">
                                        AZ
                                    </a>
                                </li>
                            @endunless
                            @unless(session('locale') === 'en')
                                <li>
                                    <a href="{{ url($lang['en']) }}" class="btn btn-lang">
                                        EN
                                    </a>
                                </li>
                            @endunless
                            @unless(session('locale') === 'ru')
                                <li>
                                    <a href="{{ url($lang['ru']) }}" class="btn btn-lang">
                                        RU
                                    </a>
                                </li>
                            @endunless
                        </ul>
                    </li>
                </ul>
                <button class="btn btn-nav text-white">
                    <i data-feather="grid"></i>
                </button>
                <a href="{{ $socials->where('title', 'WhatsApp')->first()->url }}"
                   class="d-none d-lg-flex align-items-center gap-2 btn btn-main dark custom-rounded"
                   target="_blank">
                    {!! $socials->where('title', 'WhatsApp')->first()->icon !!}
                    <span>
                        {{ __('Contact now')}}
                    </span>
                </a>
            </div>
        </div>
    </div>
</header>
