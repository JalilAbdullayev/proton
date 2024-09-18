@extends('admin.layouts.master')
@section('title', 'Kateqoriyalar')
@section('css')
    <link rel="stylesheet" href="{{ asset('back/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}"/>
    <link rel="stylesheet"
          href="{{ asset('back/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}"/>

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
    <div class="row">
        <div class="col-4">
            <div class="card">
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
                    <form action="{{ route('admin.category.store') }}" method="POST">
                        @csrf
                        <div class="tab-content">
                            <div class="tab-pane p-20 active" id="en" role="tabpanel">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="title[]" id="title" placeholder="Ad"
                                           maxlength="255" required/>
                                    <label for="title" class="form-label text-white-50">
                                        Ad
                                    </label>
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="hidden" name="lang[]" value="en"/>
                            </div>
                            <div class="tab-pane p-20" id="az" role="tabpanel">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="title[]" id="title" placeholder="Ad"
                                           maxlength="255"
                                           required/>
                                    <label for="title" class="form-label text-white-50">
                                        Ad
                                    </label>
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="hidden" name="lang[]" value="az"/>
                            </div>
                            <div class="tab-pane p-20" id="ru" role="tabpanel">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="title[]" id="title" placeholder="Ad"
                                           maxlength="255"
                                           required/>
                                    <label for="title" class="form-label text-white-50">
                                        Ad
                                    </label>
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="hidden" name="lang[]" value="ru"/>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-purple w-100">
                            Yarat
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped border">
                    <thead>
                    <tr>
                        <th>
                            Ad
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Əməliyyatlar
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr id="{{ $item->id }}">
                            <td>
                                {{ $item->translated->first()->title }}
                            </td>
                            <td>
                                <input type="checkbox" @checked($item->status) class="js-switch" data-size="small"
                                       data-secondary-color="#f62d51"/>
                            </td>
                            <td>
                                <a href="{{ route('admin.category.edit', $item->id) }}" class="btn btn-outline-warning">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                                <button class="btn btn-outline-danger">
                                    <i class="ti-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset("back/node_modules/datatables.net/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("back/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js")}}"></script>
    <script>
        $('#myTable').DataTable({
            ordering: false
        });
        deletePrompt('kateqoriyanı', '{{ route('admin.category.destroy', ':id') }}', 'Kateqoriya')
        statusAlert('{{ route('admin.category.status') }}')
    </script>
@endsection
