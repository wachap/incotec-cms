@extends('layouts.layout')

@section('scripts-bottom')
	<script src="//cdn.ckeditor.com/4.4.6/standard/ckeditor.js"></script>
@stop

<?php
	if ( isset($noticia) ):
		$form_data = ['route' => ['noticia_update', $noticia->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form', 'files' => 'true'];
		$action    = 'Editar';
		$title = $noticia->title;
		$body = $noticia->body;

	else:
		$body = null;	
		$noticia = null;	
		$title = null;
		$form_data = ['route' => 'noticia_store', 'method' => 'POST', 'role' => 'form', 'class' => 'form', 'files' => 'true'];
		$action    = 'Crear';        

	endif;
?>

@section('title')
	{{ $action }} noticia
@stop

@section('content')
	<div class="limit container">
		<div class="form-container">
			{{ Form::model($noticia, $form_data) }}

			<div class="form-content">
				<a href="{{ route('noticias') }}" class="btn btn-info">Lista</a>
			</div>

			<h3 class="form-title">{{ $action }} Noticia</h3>

			@include('layouts.errors')			

			<div class="form-content">
				{{ Form::label('title', 'Titulo', ['class' => 'form-label'])}}
				{{ Form::input('text', 'title', $title, ['class' => 'form-control']) }}
			</div>

			<div class="form-content">
				{{ Form::label('image_url', 'Eliga una imagen', ['class' => 'form-label']) }}
				{{ Form::file("image_url", ['class' => 'form-control']) }}
			</div>

			<div class="form-content">
				{{ Form::label('body', 'Cuerpo de la noticia', ['class' => 'form-label']) }}
				{{ Form::textarea("body", $body, ['class' => 'form-control ckeditor']) }}
			</div>

			<div class="form-content">
				{{ Form::submit('Registrar', ['class' => 'btn btn-succes']) }}
			</div>

			{{ Form::close() }}
		</div>
	</div>
@stop