@extends('admin.layouts.master')
@section('title', 'Başlıqlar')
@section('css')
	<link rel="stylesheet" href="{{ asset('back/ckeditor/samples/css/samples.css') }}"/>
	<link rel="stylesheet" href="{{ asset('back/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}"/>
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
	<form class="card" method="POST">
		@csrf
		@method("PUT")
		<div class="card-body">
			<ul class="nav nav-tabs customtab2" role="tablist">
				@foreach($home->translate()->orderBy('lang')->get() as $index => $lang)
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
				@foreach($home->translate()->orderBy('lang')->get() as $index => $thome)
					<div class="tab-pane p-20 @if($index === 0) active @endif" id="{{ $thome->lang }}"
						 role="tabpanel">
						<div class="mb-3">
							<label for="services_title" class="form-label text-white-50">
								Xidmətlər Başlıq
							</label>
							<input type="text" maxlength="255" name="services_title[]" id="services_title"
								   class="form-control" placeholder="Xidmətlər Başlıq"
								   value="{{ $thome->services_title }}"/>
						</div>
						<div class="mb-3">
							<label for="services_subtitle" class="form-label text-white-50">
								Xidmətlər Alt başlıq
							</label>
							<input type="text" name="services_subtitle[]" id="services_subtitle" maxlength="255"
								   placeholder="Xidmətlər Alt başlıq" class="form-control"
								   value="{{ $thome->services_subtitle }}"/>
						</div>
						<div class="mb-3">
							<label for="portfolio_title" class="form-label text-white-50">
								Portfolio Başlıq
							</label>
							<input type="text" maxlength="255" name="portfolio_title[]" id="portfolio_title"
								   class="form-control" placeholder="Portfolio Başlıq"
								   value="{{ $thome->portfolio_title }}"/>
						</div>
						<div class="mb-3">
							<label for="portfolio_subtitle" class="form-label text-white-50">
								Portfolio Alt başlıq
							</label>
							<input type="text" name="portfolio_subtitle[]" id="portfolio_subtitle" maxlength="255"
								   placeholder="Portfolio Alt başlıq" class="form-control"
								   value="{{ $thome->portfolio_subtitle }}"/>
						</div>
						<div class="mb-3">
							<label for="clients_title" class="form-label text-white-50">
								Müştərilər Başlıq
							</label>
							<input type="text" maxlength="255" name="clients_title[]" id="clients_title"
								   class="form-control" placeholder="Müştərilər Başlıq"
								   value="{{ $thome->clients_title }}"/>
						</div>
						<div class="mb-3">
							<label for="team_title" class="form-label text-white-50">
								Komanda Başlıq
							</label>
							<input type="text" maxlength="255" name="team_title[]" id="team_title"
								   placeholder="Komanda Başlıq" class="form-control" value="{{ $thome->team_title }}"/>
						</div>
						<div class="mb-3">
							<label for="team_subtitle" class="form-label text-white-50">
								Komanda Alt başlıq
							</label>
							<input type="text" name="team_subtitle[]" id="team_subtitle" maxlength="255"
								   placeholder="Komanda Alt başlıq" class="form-control"
								   value="{{ $thome->team_subtitle }}"/>
						</div>
						<div class="mb-3">
							<label for="team_description" class="form-label text-white-50">
								Komanda ətraflı
							</label>
							<textarea name="team_description[]" id="team_description" maxlength="255"
									  placeholder="Bloq Alt başlıq"
									  class="form-control @if($index === 0) text1 @elseif($index === 1) text2 @else text3 @endif"
							>{!! $thome->team_description !!}</textarea>
						</div>
						<div class="mb-3">
							<label for="blog_title" class="form-label text-white-50">
								Bloq Başlıq
							</label>
							<input type="text" maxlength="255" name="blog_title[]" id="blog_title"
								   placeholder="Bloq Başlıq" class="form-control" value="{{ $thome->blog_title }}"/>
						</div>
						<div class="mb-3">
							<label for="blog_subtitle" class="form-label text-white-50">
								Bloq Alt başlıq
							</label>
							<input type="text" name="blog_subtitle[]" id="blog_subtitle" maxlength="255"
								   placeholder="Bloq Alt başlıq" class="form-control"
								   value="{{ $thome->blog_subtitle }}"/>
						</div>
						<input type="hidden" name="lang[]" value="{{ $thome->lang }}"/>
					</div>
				@endforeach
			</div>
			<button type="submit" class="btn w-100 btn-purple text-white">
				Saxla
			</button>
		</div>
	</form>
@endsection
@section('js')
	<script src="{{ asset('back/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('back/ckeditor/samples/js/sample.js') }}"></script>
	<script>
        function createCKEditor(id) {
            CKEDITOR.replaceAll(id, {
                extraAllowedContent: 'div',
                height: 150,
            });
        }

        const text1 = createCKEditor('text1');
        const text2 = createCKEditor('text2');
        const text3 = createCKEditor('text3');
	</script>
@endsection
