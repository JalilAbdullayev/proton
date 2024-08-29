@extends('admin.layouts.master')
@section('title', 'Parametrlər')
@section('css')
	<link rel="stylesheet" href="{{ asset('back/node_modules/dropify/dist/css/dropify.min.css') }}"/>
	<style>
        textarea {
            display: block;
            height: 10rem;
        }
	</style>
@endsection
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
	<form class="card" method="POST" enctype="multipart/form-data">
		@csrf
		@method("PUT")
		<div class="card-body">
			<ul class="nav nav-tabs customtab2" role="tablist">
				@foreach($settings->translate()->orderBy('lang')->get() as $index => $lang)
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
				@foreach($settings->translate()->orderBy('lang')->get() as $index => $tsetting)
					<div class="tab-pane p-20 @if($index === 0) active @endif" id="{{ $tsetting->lang }}"
						 role="tabpanel">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" name="title[]" id="title" placeholder="Ad"
								   maxlength="255" value="{{ $tsetting->title }}" required/>
							<label for="title" class="form-label text-white-50">
								Başlıq
							</label>
						</div>
						@error('title')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<div class="form-floating mb-3">
							<input type="text" class="form-control" name="author[]" id="author" placeholder="Müəllif"
								   maxlength="255" value="{{ $tsetting->author }}" required/>
							<label for="author" class="form-label text-white-50">
								Müəllif
							</label>
						</div>
						@error('author')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<div class="form-floating mb-3">
							<input type="text" class="form-control" name="keywords[]" id="keywords"
								   placeholder="Açar şözlər" maxlength="255" value="{{ $tsetting->keywords }}"
								   required/>
							<label for="keywords" class="form-label text-white-50">
								Açar sözlər
							</label>
						</div>
						@error('keywords')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<div class="mb-3">
							<label for="description" class="form-label text-white-50">
								Açıqlama
							</label>
							<textarea class="form-control" id="description" name="description[]"
									  placeholder="Açıqlama">{{ $tsetting->description }}</textarea>
						</div>
						@error('text')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<input type="hidden" name="lang[]" value="{{ $tsetting->lang }}"/>
					</div>
				@endforeach
			</div>
			<div class="mb-3">
				<label for="logo" class="form-label text-white-50">
					Loqo
				</label>
				<input type="file" name="logo" id="logo" class="dropify" data-show-remove="false"
					   accept="image/jpeg, image/png, image/jpg, image/gif, image/svg+xml"
					   data-default-file="{{ asset(Storage::url($settings->logo)) }}"/>
			</div>
			@error('logo')
			<div class="alert alert-danger">{{ $message }}</div>
			@enderror
			<div class="mb-3">
				<label for="favicon" class="form-label text-white-50">
					Favicon
				</label>
				<input type="file" name="favicon" id="favicon" class="dropify" data-show-remove="false"
					   accept="image/jpeg, image/png, image/jpg, image/gif, image/svg+xml"
					   data-default-file="{{ asset(Storage::url($settings->favicon)) }}"/>
			</div>
			@error('favicon')
			<div class="alert alert-danger">{{ $message }}</div>
			@enderror
			<button type="submit" class="btn w-100 btn-primary text-white">
				Saxla
			</button>
		</div>
	</form>
@endsection
@section('js')
	<script src="{{ asset("back/node_modules/dropify/dist/js/dropify.min.js") }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endsection
