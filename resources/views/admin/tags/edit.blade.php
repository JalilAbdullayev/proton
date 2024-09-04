@extends('admin.layouts.master')
@section('title', 'Teq Redaktə')
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
    <form class="card" method="POST" action="{{ route('admin.tag.update', $tag->id) }}">
        @csrf
        @method("PATCH")
        <div class="card-body">
            <ul class="nav nav-tabs customtab2" role="tablist">
                @foreach($tag->translate as $index => $lang)
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
                @foreach($tag->translate as $index => $ttag)
                    <div class="tab-pane p-20 @if($index === 0) active @endif" id="{{ $ttag->lang }}"
                         role="tabpanel">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="title[]" id="title" placeholder="Ad"
                                   maxlength="255" value="{{ $ttag->title }}" required/>
                            <label for="title" class="form-label text-white-50">
                                Ad
                            </label>
                        </div>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="lang[]" value="{{ $ttag->lang }}"/>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn w-100 btn-purple text-white">
                Saxla
            </button>
        </div>
    </form>
@endsection
