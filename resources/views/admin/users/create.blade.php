@extends('admin.layouts.master')
@section('title', 'Yeni İstifadəçi')
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
                        <a href="{{ route('admin.users.index') }}">
                            İstifadəçilər
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
    <form class="card" method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="name" placeholder="Ad" maxlength="255"
                       required/>
                <label for="name" class="form-label text-white-50">
                    Ad
                </label>
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" maxlength="255"
                       required/>
                <label for="email" class="form-label text-white-50">
                    E-mail
                </label>
            </div>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Şifrə"
                       maxlength="255" required autocomplete="new-password"/>
                <label for="password" class="form-label text-white-50">
                    Şifrə
                </label>
            </div>
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password_confirmation" id="password-confirm"
                       placeholder="Şifrə Təkrar" required maxlength="255" autocomplete="new-password"/>
                <label for="password-confirm" class="form-label text-white-50">
                    Şifrə Təkrar
                </label>
            </div>
            @error('password_confirm')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn w-100 btn-purple text-white">
                Add
            </button>
        </div>
    </form>
@endsection
