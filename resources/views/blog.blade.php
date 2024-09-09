@php use Illuminate\Support\Facades\Route;use Illuminate\Support\Facades\Storage;use SHTayeb\Bookworm\Bookworm; @endphp
@extends('layouts.master')
@section('title', 'Blog')
@section('content')
	<!-- Breadcrumb start -->
	<section class="breadcrumb">
		<div class="container-fluid">
			<div class="breadcrumb-bg">
				<div class="h-100 row flex-column justify-content-center align-content-center text-center">
					<h3 class="breadcrumb-title">
						@if(Route::is('blog.category'))
							{{ $category->title }}
						@elseif(Route::is('blog.tag'))
							{{ $tag->title }}
						@elseif(Route::is('blog.search') || Route::is('search'))
							{{ $search }}
						@else
							Blog
						@endif</h3>
					<ul class="breadcrumb-box">
						<li>
							<a href="/">Home</a>
						</li>
						@unless(Route::is('blog.index') || Route::is('search'))
							<li>
								<i data-feather="chevron-left"></i>
							</li>
							<li>
								<a href="{{ route('blog.index') }}">
									Blog
								</a>
							</li>
						@endunless
						@unless(Route::is('search'))
							<li>
								<i data-feather="chevron-left"></i>
							</li>
							Blog
						@endunless
						@if(Route::is('blog.category'))
							<li>
								<i data-feather="chevron-left"></i>
							</li>
							<li>
								<a href="#">
									{{ $category->title }}
								</a>
							</li>
						@elseif(Route::is('blog.tag'))
							<li>
								<i data-feather="chevron-left"></i>
							</li>
							<li>
								<a href="#">
									{{ $tag->title }}
								</a>
							</li>
						@elseif(Route::is('blog.search') || Route::is('search'))
							<li>
								<i data-feather="chevron-left"></i>
							</li>
							<li>
								<a href="#">
									{{ $search }}
								</a>
							</li>
						@endif
					</ul>
				</div>
				<img src="{{ asset('front/images/bg/breadcrumb.png')}}" class="breadcrumb-img" alt=""/>
			</div>
		</div>
	</section>
	<!-- Breadcrumb end -->
	<!-- Blog start -->
	<section class="blog-section py-5">
		<div class="container">
			<div class="row">
				@foreach($blog as $article)
					<div class="col-12 col-md-6 col-lg-4">
						<div class="blog-card">
							<div class="blog-img">
								@unless(Route::is('search'))
									<a href="{{ route('article', $article->translated->first()->slug) }}">
										<img src="{{ asset(Storage::url('blog/'.$article->image->image)) }}" alt="">
									</a>
								@else
									<a href="{{ route('service', $article->translated->first()->slug) }}">
										<img src="{{ asset(Storage::url($article->image)) }}" alt="">
									</a>
								@endunless
							</div>
							<div class="blog-body">
								@unless(Route::is('search'))
									<div class="auth-head">
                                <span class="auth-name">
                                    By <a href="#!">
                                        {{ $article->author->name }}
                                    </a>
                                </span>
										<span class="time">
                                        {{ (new Bookworm())->estimate($article->translated->first()->full_text) }} read
                                    </span>
									</div>
								@endunless
								<div class="blog-content">
									<h3 class="blog-title">
										@unless(Route::is('search'))
											<a href="{{ route('article', $article->translated->first()->slug) }}">
												{{ $article->translated->first()->title }}
											</a>
										@else
											<a href="{{ route('service', $article->translated->first()->slug) }}">
												{{ $article->translated->first()->title }}
											</a>
										@endunless
									</h3>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			{{ $blog->links() }}
		</div>
	</section>
	<!-- Blog end -->
@endsection
