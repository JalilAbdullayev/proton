@php use Illuminate\Support\Facades\Storage; @endphp
@extends('admin.layouts.master')
@section('title', 'Portfolio')
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
                    <li class="breadcrumb-item active">
                        @yield('title')
                    </li>
                </ol>
                <a href="{{ route('admin.portfolio.create') }}"
                   class="btn btn-purple d-none d-lg-block m-l-15 text-white">
                    <i class="ti-plus"></i> Yeni Proyekt
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
            <tbody>
            @foreach($data as $item)
                <tr id="{{ $item->id }}">
                    <td>
                        {{ $item->translate->where('lang', session('locale'))->first()->title }}
                    </td>
                    <td>
                        <a href="{{ route('admin.portfolio.images.index', $item->id) }}">
                            <img src="{{ asset(Storage::url('portfolio/'.$item->image->image)) }}" alt="" class="w-25"/>
                        </a>
                    </td>
                    <td>
                        <input type="checkbox" @checked($item->status) class="js-switch" data-size="small"
                               data-secondary-color="#f62d51"/>
                    </td>
                    <td class="w-25">
                        <a href="{{ route('admin.portfolio.images.index', $item->id) }}"
                           class="btn btn-outline-purple mx-1">
                            <i class="mdi mdi-image-filter"></i>
                        </a>
                        <a href="{{ route('admin.portfolio.edit', $item->id) }}" class="btn btn-outline-warning mx-1">
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
                url: '{{ route('admin.portfolio.destroy', ':id') }}'.replace(':id', id),
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
                url: "{{ route('admin.portfolio.status') }}",
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
    </script>
@endsection