@extends('admin.layouts.master')
@section('title', 'Üzv Redaktə')
@section('css')
    <link rel="stylesheet" href="{{ asset('back/node_modules/dropify/dist/css/dropify.min.css') }}"/>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.team.index') }}">
                            Komanda
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @yield('title')
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <form class="card" method="POST" enctype="multipart/form-data" action="{{ route('admin.team.update', $member->id) }}">
        @csrf
        @method('PATCH')
        <div class="card-body">
            <ul class="nav nav-tabs customtab2" role="tablist">
                @foreach($member->translate as $index => $lang)
                    <li class="nav-item">
                        <a class="nav-link @if($index === 0) active @endif" data-bs-toggle="tab"
                           href="#{{ $lang->lang }}" role="tab">
                            <span class="hidden-xs-down">
                                @if($lang->lang === 'en')
                                    English
                                @elseif($lang->lang === 'ru')
                                    Русский
                                @else
                                    Azərbaycanca
                                @endif
                        </span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach($member->translate as $index => $tmember)
                    <div class="tab-pane p-20 @if($index === 0) active @endif" id="{{ $tmember->lang }}"
                         role="tabpanel">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name[]" id="name" placeholder="Ad"
                                   maxlength="255" value="{{ $tmember->name }}" required/>
                            <label for="name" class="form-label text-white-50">
                                Ad
                            </label>
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="position[]" id="position"
                                   placeholder="Vəzifə" value="{{ $tmember->position }}" maxlength="255"/>
                            <label for="position" class="form-label text-white-50">
                                Vəzifə
                            </label>
                        </div>
                        @error('position')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="lang[]" value="{{ $tmember->lang }}"/>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="image" class="form-label text-white-50">
                    Şəkil
                </label>
                <input type="file" name="image" id="image" class="dropify" data-show-remove="false"
                       accept="image/jpeg, image/png, image/jpg, image/gif, image/svg+xml"
                       data-default-file="{{ asset(Storage::url($member->image)) }}"/>
            </div>
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn w-100 btn-purple text-white">
                Saxla
            </button>
        </div>
    </form>
@endsection
@section('js')
    <script src="{{ asset("back/node_modules/dropify/dist/js/dropify.min.js") }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endsection
