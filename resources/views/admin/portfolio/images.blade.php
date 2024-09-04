@php use Illuminate\Support\Facades\Storage; @endphp
@extends('admin.layouts.master')
@section('title', 'Proyekt Şəkilləri')
@section('css')
    <link rel="stylesheet" href="{{ asset('back/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}"/>
    <link rel="stylesheet"
          href="{{ asset('back/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}"/>
    <link href="{{ asset('back/node_modules/switchery/dist/switchery.min.css')}}" rel="stylesheet"/>
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.portfolio.edit', $project->id) }}">
                            {{ $project->title }}
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
            <tbody>
            @foreach($data as $item)
                <tr id="{{ $item->id }}">
                    <td>
                        <img src="{{ asset(Storage::url('portfolio/'.$item->image)) }}" alt="" class="w-25"/>
                    </td>
                    <td>
                        <button
                            class="btn btn-{{ $item->featured ? 'success featuredImage' : 'danger featured' }}">
                            <i class="mdi mdi-star{{ $item->featured ? '' : '-outline' }}"></i>
                        </button>
                    </td>
                    <td>
                        <input type="checkbox" @checked($item->status) class="js-switch" data-size="small"
                               data-secondary-color="#f62d51"/>
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
    <script src="{{ asset('back/node_modules/switchery/dist/switchery.min.js')}}"></script>
    <script>
        $('#myTable').DataTable({
            ordering: false
        });
        $('.js-switch').each(function() {
            new Switchery(this, $(this).data());
        });
        $('.btn-outline-danger').click(function() {
            let id = $(this).closest('tr').attr('id');
            $.ajax({
                url: '{{ route('admin.portfolio.images.delete', ':id') }}'.replace(':id', id),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                async: false,
                success: function() {
                    $('tr#' + id + '').remove();
                },
                error: function() {
                    alert('error');
                }
            });
        });
        $('.js-switch').change(function() {
            let id = $(this).closest('tr').attr('id');
            $.ajax({
                url: "{{ route('admin.portfolio.images.status', ':id') }}".replace(':id', id),
                type: "POST",
                async: false,
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                error: function() {
                    alert('error');
                }
            })
        })
        $('.featured').click(function() {
            let id = $(this).closest('tr').attr('id');
            let self = $(this);
            $.ajax({
                url: "{{ route('admin.portfolio.images.featured', ':id') }}".replace(':id', id),
                type: "POST",
                async: false,
                data: {
                    _method: 'PUT',
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    self.removeClass('btn-danger featured').addClass('btn-success featuredImage');
                    $('.featuredImage').not(self).removeClass('btn-success featuredImage').addClass('btn-danger featured');
                    self.find('i').removeClass('mdi-star-outline').addClass('mdi-star');
                    $('.featured').not(self).find('i').removeClass('mdi-star').addClass('mdi-star-outline');
                },
                error: function() {
                    console.log('error');
                }
            })
        })
        $('#saveImage').click(function() {
            $('#newImageForm').submit();
        });
    </script>
@endsection
