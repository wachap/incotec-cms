@extends('layouts.layout')
 
@section('title')
	Identificación
@stop


@section('content')

 	<div class="limit">	
		{{ Form::open(array('route' => 'login', 'class'=>'form form-login', 'method' => 'POST')) }}

			@if(Session::has('msg'))		
			<div class="alert alert-danger">
				<p>{{ Session::get('msg') }}</p>
			</div>
			@endif
			
			@include('layouts.errors')	

			@if (Session::has('succes'))
			<div class="alert alert-success">
				<p>{{ Session::get('succes') }}</p>
			</div>
			@endif

			<h2 class="form-title">Por favor inicie sesión</h2>

			<div class="form-content">
				{{ Form::email('email', null, array('placeholder'=>'Ingrese su correo electronico','class'=>'form-control', 'required'=>'true', 'autofocus'=>'true')) }}
			</div>

			<div class="form-content">		
				{{ Form::password('password', array('placeholder'=>'Ingrese su contraseña','class'=>'form-control', 'required'=>'true')) }}
			</div>

			<div class="form-content">			
				<label class="remember-me">
					{{ Form::checkbox('remember') }} Recordarme
				</label>			
			</div>
			
			<div class="form-content submit">
				<a href="{{ route('forgot') }}" class="forgot">¿Olvidó su contraseña?</a>
				{{ Form::submit('Ingresar', array('class'=>'btn-primary')) }}		
			</div>	

		{{ Form::close() }}	
	</div>

@stop

