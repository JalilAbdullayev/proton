@extends('admin.layouts.master')
@section('title', 'Sosial Redaktə')
<style>
    textarea {
        display: block;
        height: fit-content;
    }
</style>
@section('css')
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
	<section class="card">
		<div class="card-body">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="name" placeholder="Ad"
					   maxlength="255" value="{{ $message->name }}" disabled/>
				<label for="name" class="form-label text-white-50">
					Ad
				</label>
			</div>
			<div class="form-floating mb-3">
				<input type="tel" class="form-control" id="phone" placeholder="Telefon"
					   maxlength="255" value="{{ $message->phone }}" disabled/>
				<label for="phone" class="form-label text-white-50">
					Telefon
				</label>
			</div>
			<div class="form-floating mb-3">
				<input type="tel" class="form-control" id="email" placeholder="Telefon"
					   maxlength="255" value="{{ $message->email }}" disabled/>
				<label for="email" class="form-label text-white-50">
					Telefon
				</label>
			</div>
			<div class="mb-3">
				<label for="message" class="form-label text-white-50">
					Mesaj
				</label>
				<textarea id="message" class="form-control" disabled>{{ $message->message }}</textarea>
			</div>
			<a href="mailto:{{ $message->email }}" class="btn w-100 btn-purple text-white">
				Cavabla
			</a>
		</div>
	</section>
@endsection
