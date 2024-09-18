@php use Illuminate\Support\Facades\Storage; @endphp
@extends('admin.layouts.master')
@section('title', 'Bloq')
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
                <a href="{{ route('admin.blog.create') }}"
                   class="btn btn-purple d-none d-lg-block m-l-15 text-white">
                    <i class="ti-plus"></i> Yeni Məqalə
                </a>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="table-responsive">
        <table id="myTable" class="table table-striped border">
            <thead>
            <tr>
                <th>
                    Başlıq
                </th>
                <th>
                    Kateqoriya
                </th>
                <th>
                    Şəkil
                </th>
                <th>
                    Status
                </th>
                <th>
                    Əməliyyatlar
                </th>
            </tr>
            </thead>
            <tbody id="sortable-tbody" data-route="{{ route('admin.blog.sort') }}">
            @foreach($data as $item)
                <tr id="{{ $item->id }}" data-id="{{ $item->id }}" data-order="{{ $item->order }}">
                    <td>
                        {{ $item->translated->first()->title }}
                    </td>
                    <td>
                        {{ $item->category->translated->first()->title }}
                    </td>
                    <td>
                        <a href="{{ route('admin.blog.images.index', $item->id) }}">
                            <img src="{{ asset(Storage::url('blog/'.$item->image->image)) }}" alt="" class="w-25"/>
                        </a>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input type="checkbox" @checked($item->status) class="js-switch form-check-input"/>
                        </div>
                    </td>
                    <td class="w-25">
                        <a href="{{ route('admin.blog.images.index', $item->id) }}"
                           class="btn btn-outline-purple mx-1">
                            <i class="mdi mdi-image-filter"></i>
                        </a>
                        <a href="{{ route('admin.blog.edit', $item->id) }}" class="btn btn-outline-warning mx-1">
                            <i class="ti-pencil-alt"></i>
                        </a>
                        <button class="btn btn-outline-danger mx-1">
                            <i class="ti-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <script src="{{asset("back/node_modules/datatables.net/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("back/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js")}}"></script>
    <script>
        $('#myTable').DataTable({
            ordering: false
        });
        deletePrompt('məqaləni', '{{ route('admin.blog.destroy', ':id') }}', 'Məqalə')
        statusAlert("{{ route('admin.blog.status') }}")
    </script>
@endsection
