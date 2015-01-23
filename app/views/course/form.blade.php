@extends('layouts.layout')

<?php
	if (isset($course)):		
		$form_data    = ['route' => ['carrera_update', $course->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form', 'files' => 'true'];
		$title        = $course->title;		
		$instructor   = $course->instructor;
		$address      = $course->address;
		$course_level = $course->course_level;
		$body         = $course->body;

		$action    = 'Editar';

	else:
		$form_data = ['route' => 'carrera_store', 'method' => 'POST', 'role' => 'form', 'class' => 'form', 'files' => 'true'];
		$title        = null;
		$instructor   = null;
		$address      = null;
		$course_level = 'profesional';
		$body         = null;	
		$course       = null;	

		$action    = 'Crear';        

	endif;
?>

@section('title')
	{{ $action }} Carrera
@stop

@section('content')
	<div class="limit container">
		<div class="form-container">

		{{ Form::model($course, $form_data) }}

		<div class="form-content">
			<a href="{{ route('courses') }}" class="btn btn-info">Lista</a>
		</div>

		<h3 class="form-title">{{ $action }} Carrera</h3>

		@include('layouts.errors')			

		<div class="form-content">
			{{ Form::label('title', 'Titulo', ['class' => 'form-label'])}}
			{{ Form::input('text', 'title', $title, ['class' => 'form-control', 'required'=>'true']) }}
		</div>	

		<div class="form-content">
			{{ Form::label('instructor', 'Instructor', ['class' => 'form-label'])}}
			{{ Form::textarea("instructor", $instructor, ['class' => 'form-control', 'required' => 'true']) }}
		</div>

		<div class="form-content">
			{{ Form::label('image_url', 'Eliga una imagen', ['class' => 'form-label']) }}
			{{ Form::file('image_url', ['class' => 'form-control']) }}
		</div>

		<div class="form-content">
			{{ Form::label('address', 'Escriba la duracion', ['class' => 'form-label'])}}
			{{ Form::text('address', $address, ['class' => 'form-control', 'required'=>'true']) }}
		</div>

		<div class="form-content">
			{{ Form::label('course_level', 'Seleccione el nivel academico', ['class' => 'form-label'])}}
			{{ Form::select('course_level',  array( 'profesional' => 'Profesional', 'tecnico' => 'Tecnico', 'curso' => 'Curso' ), $course_level, ['class' => 'form-control' ]) }}
		</div>

		<div class="form-content">
			{{ Form::label('body', 'Cuerpo del carrera', ['class' => 'form-label']) }}
			{{ Form::textarea("body", $body, ['class' => 'form-control', 'required' => 'true']) }}
		</div>

		<div class="form-content">
			{{ Form::submit('Registrar', ['class' => 'btn btn-succes']) }}
		</div>

		{{ Form::close() }}

		</div>

	</div>

@stop