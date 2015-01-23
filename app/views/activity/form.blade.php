@extends('layouts.layout')

<?php
	if ( isset($activity) ):

		$form_data  = ['route' => ['evento_update', $activity->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form', 'files' => true];							
		$title      = $activity->title;		
		$date_begin = $activity->date_begin;		
		$date_end   = $activity->date_end;		
		$time       = $activity->time;		
		$body       = $activity->body;		
		$programme  = $activity->programme;	

		$action    = 'Editar';

	else:

		$form_data  = ['route' => 'evento_store', 'method' => 'POST', 'role' => 'form', 'class' => 'form', 'files' => true];
		$title      = null;
		$date_begin = null;
		$date_end   = null;
		$time       = '00:00 - 00:00';
		$body       = null;	
		$programme  = null;
		$activity   = null;
		
		$action    = 'Crear'; 

	endif;
?>

@section('title')
	{{ $action }} evento
@stop

@section('content')
	<div class="limit container">
		<div class="form-container">

			{{ Form::model($activity, $form_data) }}

			<div class="form-content">
				<a href="{{ route('activities') }}" class="btn btn-info">Lista</a>
			</div>

			<h3 class="form-title">{{ $action }} Evento</h3>

			@include('layouts.errors')			

			<div class="form-content">
				{{ Form::label('title', 'Titulo', ['class' => 'form-label']) }}
				{{ Form::input('text', 'title', $title, ['class' => 'form-control', 'required'=>'true']) }}
			</div>		

			<div class="form-content">
				{{ Form::label('date_begin', 'Eliga la fecha de inicio', ['class' => 'form-label']) }}
				{{ Form::input('date', 'date_begin', $date_begin, ['class' => 'form-control', 'required'=>'true']) }}
			</div>

			<div class="form-content">
				{{ Form::label('date_end', 'Eliga la fecha de finalizacion', ['class' => 'form-label']) }}
				{{ Form::input('date', 'date_end', $date_end, ['class' => 'form-control', 'required'=>'true']) }}
			</div>

			<div class="form-content">
				{{ Form::label('time', 'Escriba la hora', ['class' => 'form-label'])}}
				{{ Form::text('time', $time, ['class' => 'form-control', 'placeholder' => '00:00 - 00:00', 'required'=>'true']) }}
			</div>

			<div class="form-content">
				{{ Form::label('body', 'Cuerpo del evento', ['class' => 'form-label']) }}
				{{ Form::textarea("body", $body, ['class' => 'form-control', 'required'=>'true']) }}
			</div>

			<div class="form-content">
				{{ Form::label('programme', 'Cuerpo del programa', ['class' => 'form-label']) }}
				{{ Form::textarea("programme", $programme, ['class' => 'form-control', 'required'=>'true']) }}
			</div>

			<div class="form-content">
				{{ Form::submit('Registrar', ['class' => 'btn btn-succes']) }}
			</div>

			{{ Form::close() }}

		</div>
	</div>
@stop