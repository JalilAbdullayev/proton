@extends('admin.layouts.master')
@section('title', 'Yeni Proyekt')
@section('css')
    <link rel="stylesheet" href="{{ asset('back/ckeditor/samples/css/samples.css') }}"/>
    <link rel="stylesheet" href="{{ asset('back/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}"/>
    <link rel="stylesheet" href="{{ asset('back/node_modules/select2/dist/css/select2.min.css')}}"/>
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
                        <a href="{{ route('admin.portfolio.index') }}">
                            Portfolio
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
    <form class="card" method="POST" enctype="multipart/form-data" action="{{ route('admin.portfolio.store') }}">
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
                        <input type="text" class="form-control" name="date[]" id="date" placeholder="Tarix"
                               maxlength="255"/>
                        <label for="date" class="form-label text-white-50">
                            Tarix
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="duration[]" id="duration" placeholder="Müddət"
                               maxlength="255"/>
                        <label for="duration" class="form-label text-white-50">
                            Müddət
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="status[]" id="status" placeholder="Status"
                               maxlength="255"/>
                        <label for="status" class="form-label text-white-50">
                            Status
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="location[]" id="location" placeholder="Məkan"
                               maxlength="255"/>
                        <label for="location" class="form-label text-white-50">
                            Məkan
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control text1" name="full_text[]" id="full_text"
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
                        <input type="text" class="form-control" name="date[]" id="date" placeholder="Tarix"
                               maxlength="255"/>
                        <label for="date" class="form-label text-white-50">
                            Tarix
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="duration[]" id="duration" placeholder="Müddət"
                               maxlength="255"/>
                        <label for="duration" class="form-label text-white-50">
                            Müddət
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="status[]" id="status" placeholder="Status"
                               maxlength="255"/>
                        <label for="status" class="form-label text-white-50">
                            Status
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="location[]" id="location" placeholder="Məkan"
                               maxlength="255"/>
                        <label for="location" class="form-label text-white-50">
                            Məkan
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control text2" name="full_text[]" id="full_text"
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
                        <input type="text" class="form-control" name="date[]" id="date" placeholder="Tarix"
                               maxlength="255"/>
                        <label for="date" class="form-label text-white-50">
                            Tarix
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="duration[]" id="duration" placeholder="Müddət"
                               maxlength="255"/>
                        <label for="duration" class="form-label text-white-50">
                            Müddət
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="status[]" id="status" placeholder="Status"
                               maxlength="255"/>
                        <label for="status" class="form-label text-white-50">
                            Status
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="location[]" id="location" placeholder="Məkan"
                               maxlength="255"/>
                        <label for="location" class="form-label text-white-50">
                            Məkan
                        </label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control text3" name="full_text[]" id="full_text"
                                  placeholder="Mətn"></textarea>
                        <label for="full_text" class="form-label text-white-50">
                            Mətn
                        </label>
                    </div>
                    <input type="hidden" name="lang[]" value="ru"/>
                </div>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label text-white-50">
                    Kateqoriya
                </label>
                <select name="category_id" id="category_id" class="w-100">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->translate->where('lang', session('locale'))->first()->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label text-white-50">
                    Şəkillər
                </label>
                <input type="file" name="images[]" id="image" class="form-control"
                       accept="image/jpeg, image/png, image/jpg, image/gif, image/svg+xml" multiple/>
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
    <script src="{{ asset('back/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('back/ckeditor/samples/js/sample.js') }}"></script>
    <script src="{{ asset('back/node_modules/select2/dist/js/select2.full.min.js')}}"></script>
    <script>
        $("#category_id").select2();

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
