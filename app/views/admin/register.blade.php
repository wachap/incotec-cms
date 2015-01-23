@extends('layouts.layout')
 
<?php	
	if (isset($user)):		
		$form_data = ['route' => ['update_account'], 'method' => 'PUT', 'role' => 'form', 'class' => 'form form-container'];		
		$type      = $user->type;	
		$full_name = $user->full_name;
		$email     = $user->email;

		$action    = 'Editar';

	else:
		$form_data = ['route' => 'register', 'method' => 'POST', 'role' => 'form', 'class' => 'form form-container'];
		$type      = 'user';
		$full_name = null;
		$email     = null;
		$user = null;
		
		$action    = 'Nuevo';        
	endif;
?>

@section('title')
	{{ $action }} usuario
@stop

@section('content')
	<div class="limit">
		{{ Form::model($user, $form_data) }}

		@include('layouts.errors')

		<h2 class="form-title">{{ $action }} usuario</h2>

		<div class="form-content">
			{{ Form::label('full_name', 'Nombre completo', ['class' => 'form-label']) }}
			{{ Form::text('full_name', $full_name, ['class' => 'form-control', 'required'=>'true']) }}			
		</div>

		<div class="form-content">
			{{ Form::label('email', 'Correo electronico', ['class' => 'form-label']) }}
			{{ Form::email('email', $email, ['class' => 'form-control', 'required' => 'true']) }}
		</div>

		@if ( Auth::user()->type == 'admin')		
		<div class="form-content">
			{{ Form::label('type', 'Seleccione el tipo de usuario', ['class' => 'form-label'])}}
			{{ Form::select('type',  array( 'admin' => 'Administrador', 'user' => 'Usuario' ), $type, ['class' => 'form-control' ]) }}
		</div>
		@endif
		
		<div class="form-content">
			{{ Form::label('password', 'Clave', ['class' => 'form-label']) }}
			{{ Form::password('password', ['class' => 'form-control'] ) }}
		</div>

		<div class="form-content">
			{{ Form::label('password_confirmation', 'Repite tu clave', ['class' => 'form-label']) }}
			{{ Form::password('password_confirmation', ['class' => 'form-control'] ) }}
		</div>

		<div class="form-content">
			{{ Form::submit('Registrar', array('class'=>'btn btn-succes')) }}		
		</div>	

	{{ Form::close() }}
	</div>
@stop