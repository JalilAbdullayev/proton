@php use Illuminate\Support\Facades\Route;use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.master')
@section('title', 'Portfolio')
@section('content')
    <!-- Breadcrumb start -->
    <section class="breadcrumb">
        <div class="container-fluid">
            <div class="breadcrumb-bg">
                <div class="h-100 row flex-column justify-content-center align-content-center text-center">
                    <h3 class="breadcrumb-title">{{ __('Portfolio')}}</h3>
                    <ul class="breadcrumb-box">
                        <li>
                            <a href="{{ route('home_' . session('locale')) }}">
                                {{ __('Home')}}
                            </a>
                        </li>
                        <li>
                            <i data-feather="chevron-left"></i>
                        </li>
                        <li>
                            @if(Route::is('portfolio.category_' . session('locale')))
                                <a href="{{ route('portfolio.index') }}">
                                    {{ __('Portfolio')}}
                                </a>
                            @else
                                {{ __('Portfolio')}}
                            @endif
                        </li>
                        @if(Route::is('portfolio.category_' . session('locale')))
                            <li>
                                <i data-feather="chevron-left"></i>
                            </li>
                            <li>
                                {{ $category->title }}
                            </li>
                        @endif
                    </ul>
                </div>
                <img src="{{ asset('front/images/bg/breadcrumb.png')}}" class="breadcrumb-img" alt=""/>
            </div>
        </div>
    </section>
    <!-- Breadcrumb end -->

    <!-- Projects start -->
    <section class="home-projects py-5">
        <div class="container">
            <div class="row">
                @foreach($portfolio as $project)
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="project-card main-card">
                            <div class="project-img">
                                <a href="{{ route('project_' . session('locale'), $project->translated->first()->slug) }}">
                                    <img src="{{ asset(Storage::url('portfolio/'.$project->image->image)) }}" alt=""/>
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('project_' . session('locale'), $project->translated->first()->slug) }}"
                                   class="project-title">
                                    <h3>
                                        {{ $project->translated->first()->title }}
                                    </h3>
                                    <i data-feather="arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $portfolio->links() }}
        </div>
    </section>
    <!-- Projects end -->
@endsection
