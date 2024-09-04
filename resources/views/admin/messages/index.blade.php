@php use Illuminate\Support\Facades\Storage; @endphp
@extends('admin.layouts.master')
@section('title', 'Mesajlar')
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
    <div class="table-responsive">
        <table id="myTable" class="table table-striped border">
            <thead>
            <tr>
                <th>
                    Ad
                </th>
                <th>
                    E-mail
                </th>
                <th>
                    Telefon
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
                        {{ $item->name }}
                    </td>
                    <td>
                        {{ $item->email }}
                    </td>
                    <td>
                        {{ $item->phone }}
                    </td>
                    <td>
                        <a href="{{ route('admin.message.show', $item->id) }}" class="btn btn-outline-warning mx-1">
                            <i class="ti-eye"></i>
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
        $('.btn-outline-danger').click(function() {
            let id = $(this).closest('tr').attr('id');
            Swal.fire({
                title: 'Əminsiniz?',
                text: 'Bu mesajı silmək istədiyinizdən əminsiniz?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6F42C1',
                cancelButtonColor: '#F62D51',
                confirmButtonText: 'Bəli, Sil',
                cancelButtonText: 'Xeyr, Geri qayıt',
            }).then(result => {
                if(result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('admin.message.delete', ':id') }}'.replace(':id', id),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        async: false,
                        success: function() {
                            Swal.fire({
                                icon: 'success',
                                timer: 1500,
                                background: '#303641',
                                timerProgressBar: true,
                                title: 'Mesaj uğurla silindi',
                            })
                            $('tr#' + id + '').remove();
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                timer: 1500,
                                background: '#303641',
                                timerProgressBar: true,
                                title: 'Mesaj silinərkən xəta baş verdi',
                            })
                        }
                    });
                }
            })
        });
    </script>
@endsection
