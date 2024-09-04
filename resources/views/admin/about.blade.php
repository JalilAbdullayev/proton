@extends('admin.layouts.master')
@section('title', 'Haqqımızda')
@section('css')
    <link rel="stylesheet" href="{{ asset('back/node_modules/dropify/dist/css/dropify.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('back/ckeditor/samples/css/samples.css') }}"/>
    <link rel="stylesheet" href="{{ asset('back/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}"/>
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
    <form class="card" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="card-body">
            <ul class="nav nav-tabs customtab2" role="tablist">
                @foreach($about->translate()->orderBy('lang')->get() as $index => $lang)
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
                @foreach($about->translate()->orderBy('lang')->get() as $index => $tabout)
                    <div class="tab-pane p-20 @if($index === 0) active @endif" id="{{ $tabout->lang }}"
                         role="tabpanel">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="title[]" id="title" placeholder="Ad"
                                   maxlength="255" value="{{ $tabout->title }}" required/>
                            <label for="title" class="form-label text-white-50">
                                Başlıq
                            </label>
                        </div>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="text" class="form-label text-white-50">
                                Mətn
                            </label>
                            <textarea
                                class="form-control @if($index === 0) text1 @elseif($index === 1) text2 @else text3 @endif"
                                name="description[]" placeholder="Mətn">{!! $tabout->description !!}</textarea>
                        </div>
                        @error('text')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="lang[]" value="{{ $tabout->lang }}"/>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="image" class="form-label text-white-50">
                    Şəkil
                </label>
                <input type="file" name="image" id="image" class="dropify" data-show-remove="false"
                       accept="image/jpeg, image/png, image/jpg, image/gif, image/svg+xml"
                       data-default-file="{{ asset(Storage::url($about->image)) }}"/>
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
    <script src="{{ asset('back/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('back/ckeditor/samples/js/sample.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });

        function createCKEditor(id) {
            CKEDITOR.replaceAll(id, {
                extraAllowedContent: 'div',
                height: 150,
            });
        }

        const text1 = createCKEditor('text1');
        const text2 = createCKEditor('text2');
        const text3 = createCKEditor('text3');
    </script>
@endsection
