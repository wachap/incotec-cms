@extends('layouts.layout')

<?php	
	if (isset($gallery)):		
		$form_data = ['route' => ['galeria_update', $gallery->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form'];						
		$title = $gallery->title;
		$body = $gallery->body;		

		$action    = 'Editar';

	else:
		$form_data = ['route' => 'galeria_store', 'method' => 'POST', 'role' => 'form', 'class' => 'form'];
		$title = null;
		$body = null;
		$gallery = null;
		
		$action    = 'Crear'; 
	endif;
?>

@section('title')
	Nueva galeria
@stop

@section('content')
	<div class="limit container">
		<div class="form-container">

			{{ Form::model($gallery, $form_data) }}
				<div class="form-content">
					<a href="{{ route('galleries') }}" class="btn btn-info">Lista</a>
				</div>
				
				<h3 class="form-title">{{ $action }} Galeria</h3>

				@include('layouts.errors')	
				
				<div class="form-content">
					{{ Form::label('title', 'Titulo', ['class' => 'form-label'])}}
					{{ Form::input('text', 'title', $title, ['class' => 'form-control', 'required'=>'true']) }}
				</div>		
				
				<div class="form-content">
					{{ Form::label('body', 'Cuerpo de la galeria', ['class' => 'form-label']) }}
					{{ Form::textarea("body", $body, ['class' => 'form-control', 'required'=>'true']) }}
				</div>		
				
				<div class="form-content">
					{{ Form::submit('Registrar', ['class' => 'btn btn-succes']) }}
				</div>
			{{ Form::close() }}

		</div>
	</div>
@stop