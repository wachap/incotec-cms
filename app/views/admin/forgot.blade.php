@extends('layouts.layout')
 
@section('title')
	Forgot password
@stop

@section('content')

 	<div class="limit">
	
	{{ Form::open(array('route' => 'forgot-post', 'class'=>'form form-login', 'method' => 'POST')) }}
		@if(Session::has('msg'))		
			<div class="alert alert-danger">
				<p>{{ Session::get('msg') }}</p>
			</div>
		@endif

		@if (Session::has('succes'))
			<div class="alert alert-success">
				<p>{{ Session::get('succes') }}</p>
			</div>
		@endif
		
		@if ($errors->has('email'))
			<div class="alert alert-danger">
				<p>{{ $errors->first('email') }}</p>
			</div>			
		@endif

		<h2 class="form-title">¿Olvidó su contraseña?</h2>

		<div class="form-content">
		{{ Form::email('email', null, array('placeholder'=>'Ingrese su correo electronico','class'=>'form-control', 'required'=>'true', 'autofocus'=>'true')) }}
		</div>		
		
		<div class="form-content submit">
		<a href="{{ route('login') }}" class="btn btn-primary back">Volver</a>
		{{ Form::submit('Enviar', array('class'=>'btn btn-primary')) }}		
		</div>	

	{{ Form::close() }}
	</div>

@stop