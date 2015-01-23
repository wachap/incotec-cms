@extends('layouts.layout')

<?php 	
	$OgDesc      = substr( strip_tags( $activity->body ), 0, 150 );
	$OgDescFinal = str_replace(chr(13), "", $OgDesc); 
?>

@section('title')
	{{ $activity->title }}
@stop
	
@section('og-facebook')
	<meta property="og:description" content="{{ str_replace([chr(10), '&nbsp;'],' ',$OgDescFinal) }}" />		
	<meta property="og:title" content="{{ $activity->title }}" />
	<meta property="og:image" content="{{ asset( 'images/static/incotec-nosotros.jpg' ) }}" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="{{ asset('index.php/evento/'.$activity->slug.'/'.$activity->id) }}" />
@stop

@section('content')
	<div class="container limit">

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="link"><a href="{{ route('activities') }}">Eventos</a></li>
				<li class="active">{{ $activity->title }}</li>
			</ol>
		</div>

		<div class="events-single-container">			

			<article class="events-single">

				@include('layouts.alert-success')
				@include('layouts.alert-info')
				@include('layouts.alert-warning')
				@include('layouts.errors')

				@if ( Auth::check() )
					<div class="crud-container">
						<div class="pull-right">

							<a href="{{ route('activities') }}" class="btn btn-info">Lista</a>
							<a href="{{ route('evento_edit', [$activity->id]) }}" class="btn btn-primary">Editar</a>

							{{ Form::open(['route' => ['evento_destroy', $activity->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
								{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
							{{ Form::close() }}

						</div>
					</div>
				@endif	

				<h1 style="font-weight: 700;color: #636363;font-size: 28px;" class="title-event">{{ $activity->title }}</h1>

				<div class="info">
					<span class="from">{{ date("M d, Y",strtotime($activity->date_begin)) }}</span>
					<span class="divider">A</span>
					<span class="to">{{ date("M d, Y",strtotime($activity->date_end)) }}</span>
					<span class="time">{{ $activity->time }}</span>
				</div>			

				<p>{{ str_replace(chr(13),"<br>",$activity->body) }}</p>			

				<div class="programme">

					<h3>Programación</h3>

					<p>{{ str_replace(chr(13),"<br>",$activity->programme) }}</p>

					<table class="programme-table">

						<thead>
							<tr>
								<th>#</th>
								<th>Actividad</th>
								<th>Horario</th>
							</tr>		
						</thead>

						<tbody>
							<?php $n=0; ?>

							@foreach ( $activity->programmes as $programme)							

							<?php $n=$n + 1; ?>



							@if (Auth::check())

							

							<tr>

								<td>{{ $n }}</td>

								{{ Form::model($programme, ['route' => ['programme_update', $programme->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form']) }}
								<td>
									<div class="form-content">
										{{ Form::input('text', 'title', $programme->title, ['class' => 'form-control', 'required'=>'true']) }}
									</div>
								</td>

								<td>
									<div class="form-content">
										{{ Form::input('text', 'time', $programme->time, ['class' => 'form form-control', 'required'=>'true']) }}
									</div>
								</td>
					
								<td>
									<div class="icon-edit">									
										{{ Form::submit('E', ['class' => 'btn btn-primary', 'style' => 'height: 30px;']) }}
									</div>
									
								{{ Form::close() }}

								{{ Form::open(['route' => ['programme_destroy', $programme->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
									<div class="icon-delete">
										{{ Form::submit('D', ['class' => 'btn btn-danger', 'style' => 'height: 30px;']) }}
									</div>
								{{ Form::close() }}

								</td>

							</tr>

							@else
							<tr>
								<td>{{ $n }}</td>
								<td>{{ $programme->title }}</td>
								<td>{{ $programme->time }}</td>
							</tr>
							@endif

							@endforeach

						</tbody>	

					</table>

					@if ( Auth::check() )
					{{ Form::open( ['route' => ['programme_store', $activity->id], 'method' => 'post', 'class' => 'form is-inline-block last-form', 'files' => true ] ) }}

						<p class="form-title">Agregar actividad</p>

						<div class="form-content">
							{{ Form::input('text', 'title', '', ['class' => 'form-control', 'required'=>'true', 'placeholder' => 'Escribe el titulo de la actividad']) }}
						</div>

						<div class="form-content">
							{{ Form::input('text', 'time', '00:00 - 00:00', ['class' => 'form-control', 'required'=>'true', 'placeholder' => '00:00 - 00:00']) }}
						</div>

						<div class="form-content">
							{{ Form::submit('Registrar nueva actividad', ['class' => 'btn btn-succes']) }}
						</div>

					{{ Form::close() }}	
					@endif				

				</div>

			</article>

			<div class="extra-container">
				@include('layouts.useful_links')
				@include('layouts.noticias')	
			</div>
		</div>

	</div>
@stop