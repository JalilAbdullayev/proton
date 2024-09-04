@extends('admin.layouts.master')
@section('title', 'Yeni Xidmət')
@section('css')
    <link rel="stylesheet" href="{{ asset('back/node_modules/dropify/dist/css/dropify.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('back/ckeditor/samples/css/samples.css') }}"/>
    <link rel="stylesheet" href="{{ asset('back/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}"/>
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
                        <a href="{{ route('admin.services.index') }}">
                            Xidmətlər
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
    <form class="card" method="POST" enctype="multipart/form-data" action="{{ route('admin.services.store') }}">
        @csrf
        <div class="card-body">
            <ul class="nav nav-tabs customtab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#en" role="tab">
                        <span class="hidden-xs-down">
                            English
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#az" role="tab">
                        <span class="hidden-xs-down">
                            Azərbaycanca
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                        <span class="hidden-xs-down">
                            Русский
                        </span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane p-20 active" id="en" role="tabpanel">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="title[]" id="title" placeholder="Başlıq"
                               maxlength="255" required/>
                        <label for="title" class="form-label text-white-50">
                            Başlıq
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="keywords[]" id="keywords"
                                  placeholder="Açar sözlər"></textarea>
                        <label for="keywords" class="form-label text-white-50">
                            Açar sözlər
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="description[]" id="description"
                                  placeholder="Açıqlama"></textarea>
                        <label for="description" class="form-label text-white-50">
                            Açıqlama
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="full_text[]" id="full_text"
                                  placeholder="Mətn"></textarea>
                        <label for="full_text" class="form-label text-white-50">
                            Mətn
                        </label>
                    </div>
                    <input type="hidden" name="lang[]" value="en"/>
                </div>
                <div class="tab-pane p-20" id="az" role="tabpanel">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="title[]" id="title" placeholder="Başlıq"
                               maxlength="255" required/>
                        <label for="title" class="form-label text-white-50">
                            Başlıq
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="keywords[]" id="keywords"
                                  placeholder="Açar sözlər"></textarea>
                        <label for="keywords" class="form-label text-white-50">
                            Açar sözlər
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="description[]" id="description"
                                  placeholder="Açıqlama"></textarea>
                        <label for="description" class="form-label text-white-50">
                            Açıqlama
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="full_text[]" id="full_text"
                                  placeholder="Mətn"></textarea>
                        <label for="full_text" class="form-label text-white-50">
                            Mətn
                        </label>
                    </div>
                    <input type="hidden" name="lang[]" value="az"/>
                </div>
                <div class="tab-pane p-20" id="ru" role="tabpanel">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="title[]" id="title" placeholder="Başlıq"
                               maxlength="255"
                               required/>
                        <label for="title" class="form-label text-white-50">
                            Başlıq
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="keywords[]" id="keywords"
                                  placeholder="Açar sözlər"></textarea>
                        <label for="keywords" class="form-label text-white-50">
                            Açar sözlər
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="description[]" id="description"
                                  placeholder="Açıqlama"></textarea>
                        <label for="description" class="form-label text-white-50">
                            Açıqlama
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="full_text[]" id="full_text"
                                  placeholder="Mətn"></textarea>
                        <label for="full_text" class="form-label text-white-50">
                            Mətn
                        </label>
                    </div>
                    <input type="hidden" name="lang[]" value="ru"/>
                </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label text-white-50">
                    Şəkil
                </label>
                <input type="file" name="image" id="image" class="dropify" data-show-remove="false"
                       accept="image/jpeg, image/png, image/jpg, image/gif, image/svg+xml"/>
            </div>
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn w-100 btn-purple text-white">
                Yarat
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
