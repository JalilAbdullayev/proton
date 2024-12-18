@php use Illuminate\Support\Facades\Storage; @endphp
@extends('admin.layouts.master')
@section('title', 'Məqalə Şəkilləri')
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
            <div class="d-flex justify-content-end align-items-center" style="min-width: max-content">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">
                            Ana Səhifə
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.blog.index') }}">
                            Bloq
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.blog.edit', $article->id) }}">
                            {{ $article->title }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @yield('title')
                    </li>
                </ol>
                <a href="javascript:void(0)" class="btn btn-purple m-l-15" data-bs-toggle="modal"
                   data-bs-target="#newImageModal">
                    <i class="fas fa-plus"></i> Yeni Şəkil
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
                    Şəkil
                </th>
                <th>
                    Önə çıxan
                </th>
                <th>
                    Status
                </th>
                <th>
                    Əməliyyatlar
                </th>
            </tr>
            </thead>
            <tbody id="sortable-tbody" data-route="{{ route('admin.blog.images.sort', $article->id) }}">
            @foreach($data as $item)
                <tr id="{{ $item->id }}" data-id="{{ $item->id }}" data-order="{{ $item->order }}">
                    <td>
                        <img src="{{ asset(Storage::url('blog/'.$item->image)) }}" alt="" class="w-25"/>
                    </td>
                    <td>
                        <button
                            class="btn btn-{{ $item->featured ? 'success featuredImage' : 'danger featured' }}">
                            <i class="mdi mdi-star{{ $item->featured ? '' : '-outline' }}"></i>
                        </button>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input type="checkbox" @checked($item->status) class="js-switch form-check-input"/>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-outline-danger">
                            <i class="ti-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="newImageModal" tabindex="-1" aria-labelledby="newImageModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newImageModal">
                        Upload New Image
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" id="newImageForm" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="images[]" id="images" multiple class="form-control"
                                       accept="image/jpeg, image/png, image/jpg, image/gif" required/>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" id="saveImage" class="btn btn-purple">
                        Save
                    </button>
                </div>
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
        deleteImage('{{ route('admin.blog.images.delete', ':id') }}')
        statusAlert('{{ route('admin.blog.images.status', ':id') }}')
        featured('{{ route('admin.blog.images.featured', ':id') }}')
        $('#saveImage').click(function() {
            $('#newImageForm').submit();
        });
    </script>
@endsection
