@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.master')
@section('content')
    <!-- Breadcrumb start -->
    <section class="breadcrumb">
        <div class="container-fluid">
            <div class="breadcrumb-bg">
                <div class="h-100 row flex-column justify-content-center align-content-center text-center">
                    <h3 class="breadcrumb-title">Portfolio</h3>
                    <ul class="breadcrumb-box">
                        <li>
                            <a href="/">
                                Home
                            </a>
                        </li>
                        <li>
                            <i data-feather="chevron-left"></i>
                        </li>
                        <li>
                            portfolio
                        </li>
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
                                <a href="{{ route('project', $project->translated->first()->slug) }}">
                                    <img src="{{ asset(Storage::url('portfolio/'.$project->image->image)) }}" alt=""/>
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('project', $project->translated->first()->slug) }}"
                                   class="project-title">
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
            {{ $portfolio->links() }}
        </div>
    </section>
    <!-- Projects end -->
@endsection
