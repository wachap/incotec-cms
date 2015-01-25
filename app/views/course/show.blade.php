@extends('layouts.layout')

@section('title')
	{{ $course->title }}
@stop

@section('meta-description')
	<meta name="description" content="{{ content_preview($course->body, 150) }}" />
@stop

@section('og-facebook')
	<meta property="og:description" content="{{ content_preview($course->body, 150) }}" />
	<meta property="og:title" content="{{ $course->title }}"/>
	<meta property="og:image" content="{{ asset( $course->image_url ) }}" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="{{ route('course', [$course->slug, $course->id]) }}" />
@stop

@section('content')
	<div class="container limit">

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="link"><a href="{{ route('courses') }}">Carreras</a></li>
				<li class="active">{{ $course->title }}</li>
			</ol>
		</div>

		<div class="courses-single-container">
			<article class="courses-single">

				@if (Session::has('confirm'))
					<div class="alert alert-success ">
						{{ Session::get('confirm') }}
					</div>
				@endif

				@include('layouts.errors')

				@if (Auth::check())
					<div class="crud-container">
						<div class="pull-right">
							<a href="{{ route('courses') }}" class="btn btn-info">Lista</a>
							<a href="{{ route('carrera_edit', [$course->id]) }}" class="btn btn-primary">Editar</a>
							{{ Form::open(['route' => ['carrera_destroy', $course->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
								{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
							{{ Form::close() }}
						</div>
					</div>
				@endif

				<h1 class="title">{{ $course->title }}</h1>

				<figure class="curso-imagen">
					<img src="{{ asset($course->image_url) }}" alt="{{ $course->title }}" />
				</figure>

				<dl class="info">
					<dt>Profesor(a)</dt><dd>{{ str_replace(chr(13),"<br>", $course->instructor) }}</dd>
					<dt>Id del Curso</dt><dd>{{ $course->id }}</dd>
					<dt>Duración</dt><dd>{{ $course->address }}</dd>
					<dt>Grado</dt><dd>{{ $course->course_level }}</dd>
				</dl>

				<div class="body" >{{ $course->body }}</div>

				<h3>Documentos del curso:</h3>

				<ul class="list-download">

					@foreach ($course->downloads as $download)

						@if ( Auth::check() )

						<li class="colorear">
							{{ Form::model($download, ['route' => ['download_update', $download->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form', 'files' => 'true']) }}

							<div class="form-content">
								{{ Form::select('file_type', [ 'material' => 'Material', 'modulos' => 'Modulos', 'horario' => 'Horario' ], $download->file_type, ['class' => 'form-control ', 'required'=>'true'] ) }}
							</div>

							<div class="form-content">
								{{ Form::input('text', 'description', $download->description, ['class' => 'form-control', 'required'=>'true', 'placeholder' => 'Escribe la descripcion de la descarga']) }}
							</div>

							<div class="form-content">
								{{ Form::label('file_url', 'Eliga un documento', ['class' => 'form-label']) }}
								{{ Form::file('file_url', ['class' => 'form-control']) }}
							</div>

							<div class="form-content">
								{{ Form::submit('Editar', ['class' => 'btn btn-primary']) }}
								{{ Form::close() }}

								{{ Form::open(['route' => ['download_destroy', $download->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
										{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
								{{ Form::close() }}

								<a class="btn btn-info" target="_blank" href="{{ asset($download->file_url) }}">Probar descarga</a>
							</div>
						</li>

						@else

						<li>
							<a class="box" target="_blank" href="{{ asset($download->file_url) }}">							<span class="title-download">{{ $download->file_type }}</span>
								<span class="help-block">{{ $download->description }}</span>
							</a>
						</li>

						@endif

					@endforeach

				</ul>

				@if ( Auth::check() )
					{{ Form::open( ['route' => ['download_store', $course->id], 'method' => 'post', 'class' => 'form is-inline-block last-form', 'files' => true] ) }}

						<p class="form-title">Agregar descarga</p>

						<div class="form-content">
							{{ Form::select('file_type', [ 'material' => 'Material', 'modulos' => 'Modulos', 'horario' => 'Horario' ], 'material', ['class' => 'form-control', 'required'=>'true'] ) }}
						</div>

						<div class="form-content">
							{{ Form::input('text', 'description', '', ['class' => 'form-control', 'required'=>'true', 'placeholder' => 'Escribe la descripcion de la descarga']) }}
						</div>

						<div class="form-content">
							{{ Form::label('file_url', 'Eliga un documento', ['class' => 'form-label']) }}
							{{ Form::file('file_url', ['class' => 'form-control', 'required'=>'true']) }}
						</div>

						<div class="form-content">
							{{ Form::submit('Registrar nueva descarga', ['class' => 'btn btn-succes']) }}
						</div>

					{{ Form::close() }}
				@endif
			</article>

			<div class="extra-container">
				@include('layouts.useful_links')
				@include('layouts.activities')
			</div>

		</div>

	</div>
@stop