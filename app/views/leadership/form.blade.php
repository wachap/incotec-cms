@extends('layouts.layout')

<?php
	if (isset($worker)):	

		$form_data = ['route' => ['leader_update', $worker->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form', 'files' => true];	
		$full_name = $worker->full_name;
		$image_url = $worker->image_url;
		$job_type  = $worker->job_type;
		$since     = $worker->since;
		$body      = $worker->body;

		$action    = 'Editar';

	else:
		$form_data = ['route' => 'leader_store', 'method' => 'POST', 'role' => 'form', 'class' => 'form', 'files' => true];
		$full_name = null;
		$image_url = null;
		$job_type  = null;
		$since     = null;
		$body      = null;
		$worker    = null;	

		$action    = 'Crear';        

	endif;
?>

@section('title')
	{{ $action }} trabajador
@stop

@section('content')
	<div class="limit container">
		<div class="form-container">
			{{ Form::model($worker, $form_data) }}

				<div class="form-content">
					<a href="{{ route('leadership') }}" class="btn btn-info">Lista</a>
				</div>

				<h3 class="form-title">{{ $action }} Trabajador</h3>

				@include('layouts.errors')	

				<div class="form-content">
					{{ Form::label('full_name', 'Nombre completo', ['class' => 'form-label'])}}
					{{ Form::text('full_name', $full_name, ['class' => 'form-control', 'required'=>'true']) }}
				</div>		

				<div class="form-content">
					{{ Form::label('image_url', 'Eliga una foto', ['class' => 'form-label']) }}
					{{ Form::file("image_url", ['class' => 'form-control']) }}
				</div>

				<div class="form-content">
					{{ Form::label('course_level', 'Seleccione el nivel academico', ['class' => 'form-label'])}}
					{{ Form::select('job_type',  array( 'Director' => 'Director', 'Secretaria' => 'Secretaria', 'Profesor' => 'Profesor' ), $job_type, ['class' => 'form-control' ]) }}
				</div>

				<div class="form-content">
					{{ Form::label('since', '¿Desde que fecha trabaja?', ['class' => 'form-label']) }}
					{{ Form::input('date', 'since', $since, ['class' => 'form-control', 'required'=>'true']) }}
				</div>		

				<div class="form-content">
					{{ Form::label('body', 'Descripcion del trabajador', ['class' => 'form-label']) }}
					{{ Form::textarea("body", $body, ['class' => 'form-control', 'required'=>'true']) }}
				</div>

				<div class="form-content">
					{{ Form::submit('Registrar', ['class' => 'btn btn-succes']) }}
				</div>

			{{ Form::close() }}
		</div>
	</div>
@stop