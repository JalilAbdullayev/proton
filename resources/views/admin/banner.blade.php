@extends('admin.layouts.master')
@section('title', 'Banner')
@section('css')
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
    <form class="card" method="POST">
        @csrf
        @method("PUT")
        <div class="card-body">
            <ul class="nav nav-tabs customtab2" role="tablist">
                @foreach($banner->translate()->orderBy('lang')->get() as $index => $lang)
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
                @foreach($banner->translate()->orderBy('lang')->get() as $index => $tbanner)
                    <div class="tab-pane p-20 @if($index === 0) active @endif" id="{{ $tbanner->lang }}"
                         role="tabpanel">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="title[]" id="title" placeholder="Başlıq"
                                   maxlength="255" value="{{ $tbanner->title }}" required/>
                            <label for="title" class="form-label text-white-50">
                                Başlıq
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="subtitle[]" id="subtitle"
                                   placeholder="Alt Başlıq" maxlength="255" value="{{ $tbanner->subtitle }}" required/>
                            <label for="subtitle" class="form-label text-white-50">
                                Alt Başlıq
                            </label>
                        </div>
                        <input type="hidden" name="lang[]" value="{{ $tbanner->lang }}"/>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn w-100 btn-purple text-white">
                Saxla
            </button>
        </div>
    </form>
@endsection
@section('js')
    <script src="{{ asset('back/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('back/ckeditor/samples/js/sample.js') }}"></script>
    <script>
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
