@extends('admin.layouts.master')
@section('title', 'Sosial Redaktə')
@section('css')
    <link href="{{ asset('back/node_modules/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-white-50">
                @yield('title')
            </h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">
                            Ana Səhifə
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @yield('title')
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- End Bread crumb -->
    <form class="card" method="POST" action="{{ route('admin.socials.update', $social->id) }}">
        @csrf
        @method("PATCH")
        <div class="card-body">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="title" id="title" placeholder="Ad"
                       maxlength="255" value="{{ $social->title }}"/>
                <label for="title" class="form-label text-white-50">
                    Ad
                </label>
            </div>
            @error('title')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="form-floating mb-3">
                <input type="url" class="form-control" name="url" id="url" placeholder="Link"
                       maxlength="255" value="{{ $social->url }}" required/>
                <label for="url" class="form-label text-white-50">
                    Link
                </label>
            </div>
            @error('url')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="mb-3">
                <label for="icon" class="form-label text-white-50">
                    İkon
                </label>
                <select name="icon" id="icon" class="w-100">
                    @foreach($icons as $icon)
                        <option value="{{ $icon['icon'] }}" @selected($social->icon === $icon['icon'])>
                            {{ $icon['title'] }}
                        </option>
                    @endforeach
                </select>
                <div id="icon-preview" class="my-3"></div>
            </div>
            @error('icon')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <button type="submit" class="btn w-100 btn-purple text-white">
                Saxla
            </button>
        </div>
    </form>
@endsection
@section('js')
    <script src="{{ asset('back/node_modules/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script>
        $("#icon").select2();
        $(document).ready(function() {
            var iconClass = $('#icon').val();
            $('#icon-preview').html(iconClass).addClass('fs-1');
            $('#icon').change(function() {
                iconClass = $(this).val();
                $('#icon-preview').html(iconClass).addClass('fs-1');
            });
        });
    </script>
@endsection
