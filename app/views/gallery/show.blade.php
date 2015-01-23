@extends('layouts.layout')

@section('title')
	{{ $gallery->title }}
@stop

@section('style')
	@parent
	{{ HTML::style('css/lightbox.css'); }}	
@stop

@section('scripts-bottom')
	{{-- HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'); --}}
	{{ HTML::script('js/jquery.js'); }}
	{{ HTML::script('js/lightbox.min.js'); }}
@stop


@section('content')

	<div class="container limit">
		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="link"><a href="{{ route('galleries') }}">Galeria</a></li>
				<li class="active">{{ $gallery->title }}</li>
			</ol>
		</div>

		<?php $n = 0 ?>
		@foreach ($gallery->photos as $photo)
			<?php $n = $n + 1 ?>
		@endforeach
		<div class="gallery-single-container">
			@if (Session::has('confirm'))
				<div class="alert alert-success ">
					{{ Session::get('confirm') }}
				</div>      
			@endif
			@include('layouts.errors')

			@if (Auth::check())
					<div class="crud-container">
						<div class="pull-right">
							<a href="{{ route('galleries') }}" class="btn btn-info">Lista</a>
							<a href="{{ route('galeria_edit', [$gallery->id]) }}" class="btn btn-primary">Editar</a>
							{{ Form::open(['route' => ['galeria_destroy', $gallery->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
								{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
							{{ Form::close() }}
						</div>
					</div>
				@endif	

			<h1 class="title">{{ $gallery->title }} <span class="label-info">{{ $n }} Fotos</span></h1>

			<div class="photos-container image-set">				
			@foreach ($gallery->photos as $photo)
				<?php $src = basename( $photo->image_url ).PHP_EOL; 
				$yearPath  = dirname( $photo->image_url ).PHP_EOL;
				$year      = basename( $yearPath ).PHP_EOL; ?>

				@if ( Auth::check() )
				<figure class="photo">
					{{ Form::model($photo, ['route' => ['photo_update', $photo->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form', 'files' => 'true' ]) }}
						
						<a href="{{ asset($photo->image_url) }}" data-lightbox="roadtrip" data-title="{{ $photo->title }}">
							<img src="{{ asset( 'image/'.$year.'/'.$src.'/250' ) }}" alt="{{ $photo->title }}">
						</a>
						<div class="form-content">
							{{ Form::label('image_url', 'Eliga una imagen', ['class' => 'form-label']) }}
							{{ Form::file("image_url", ['class' => 'form-control']) }}
						</div>
						<div class="form-content">
							{{ Form::label('title', 'Descriptcion', ['class' => 'form-label'])}}
							{{ Form::text( 'title', $photo->title, ['class' => 'form-control', 'required' => true] ) }}
						</div>
						<div class="form-content">
							{{ Form::submit('Editar', ['class' => 'btn btn-primary']) }}
							{{ Form::close() }}
							{{ Form::open(['route' => ['photo_destroy', $photo->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
									{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
							{{ Form::close() }}
						</div>
				</figure>
				@else

				<figure class="photo">
					<a href="{{ asset($photo->image_url) }}" data-lightbox="roadtrip" data-title="{{ $photo->title }}"><img src="{{ asset('image/'.$year.'/'.$src.'/250') }}" alt="{{ $photo->title }}"></a>
					<figcaption>{{ $photo->title }}</figcaption>
				</figure>	
					@endif
				
			@endforeach				
			</div>

			@if ( Auth::check() )
				{{ Form::open( ['route' => ['photo_store', $gallery->id], 'method' => 'post', 'class' => 'form is-inline-block last-form', 'files' => 'true'] ) }}
					<p class="form-title">Agregar foto</p>					
					
					<div class="form-content">
						{{ Form::label('image_url', 'Eliga una imagen', ['class' => 'form-label']) }}
						{{ Form::file("image_url", ['class' => 'form-control', 'required' => true]) }}
					</div>

					<div class="form-content">
						{{ Form::label('title', 'Titulo', ['class' => 'form-label'])}}
						{{ Form::text( 'title', '', ['class' => 'form-control', 'placeholder' => 'Escribe una breve descripcion de la foto', 'required' => true] ) }}
					</div>

					<div class="form-content">
						{{ Form::submit('Registrar nueva foto', ['class' => 'btn btn-succes']) }}
					</div>

				{{ Form::close() }}	
			@endif
		</div>
	</div>

@stop