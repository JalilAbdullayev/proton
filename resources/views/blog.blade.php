@php use Illuminate\Support\Facades\Storage;use SHTayeb\Bookworm\Bookworm; @endphp
@extends('layouts.master')
@section('title', 'Blog')
@section('content')
	<!-- Breadcrumb start -->
	<section class="breadcrumb">
		<div class="container-fluid">
			<div class="breadcrumb-bg">
				<div class="h-100 row flex-column justify-content-center align-content-center text-center">
					<h3 class="breadcrumb-title">Blog</h3>
					<ul class="breadcrumb-box">
						<li>
							<a href="/">Home</a>
						</li>
						<li>
							<i data-feather="chevron-left"></i>
						</li>
						<li>
							Blog
						</li>
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
								<a href="{{ route('article', $article->translated->first()->slug) }}">
									<img src="{{ asset(Storage::url('blog/'.$article->image->image)) }}" alt="">
								</a>
							</div>
							<div class="blog-body">
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
								<div class="blog-content">
									<h3 class="blog-title">
										<a href="{{ route('article', $article->translated->first()->slug) }}">
											{{ $article->translated->first()->title }}
										</a>
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
