@extends('layouts.layout')

@section('title')
	Inicio
@stop

@section('scripts-bottom')
	{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'); }}
	{{-- HTML::script('js/jquery.js'); --}}
	{{ HTML::script('js/carousel.js'); }}
@stop

@section('header')
@parent
<h1 class="home-title">Incotec</h1>
@stop

@section('content')
	
	<div class="container limit">

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="active">Incotec</li>
			</ol>
		</div>
		
		@include('layouts.errors')	

		<div class="carousel">
			<a href="#"class="carousel-left"><span class="arrow"></span></a>
			<a href="#" class="carousel-right"><span class="arrow"></span></a>
			
			<div class="carousel-inner">
				@foreach ($carrousels as $carrousel)
				@if (Auth::check())
				<div class="item">
					<img src="{{ asset($carrousel->image_url) }}" alt="{{ $carrousel->title }}" />
					<div class="caption auth">
						{{ Form::open(['route' => ['carrousel_update', $carrousel->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form form-container', 'files' => 'true']) }}
						<div class="form-content">
							{{ Form::file('image_url', ['class' => 'form-control']) }}						
						</div>
						<div class="form-content">
							{{ Form::text('title', $carrousel->title, ['class' => 'form-control', 'required'=>'true', 'placeholder' => 'Ingrese un titulo']) }}	
						</div>
						
						<div class="form-content">
							{{ Form::text('body', $carrousel->body, ['class' => 'form-control', 'placeholder' => 'Ingrese una breve descripcion.']) }}	
						</div>
						

						{{ Form::submit('Editar', ['class' => 'btn btn-primary']) }}
						{{ Form::close() }}
						<div class="pull-right">
						{{ Form::open(['route' => ['carrousel_delete', $carrousel->id], 'method' => 'delete', 'role' => 'form', 'class' => 'is-inline-block']) }}	

							{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
						{{ Form::close() }}
						{{ Form::open(['route' => 'carrousel_create', 'method' => 'POST', 'role' => 'form', 'class' => 'is-inline-block']) }}	

							{{ Form::submit('Nuevo', ['class' => 'btn btn-succes']) }}
						{{ Form::close() }}
						</div>
					</div>
				</div>
				@else
				<div class="item">
					<img src="{{ asset($carrousel->image_url) }}" alt="{{ $carrousel->title }}" />
					<div class="caption">
						<h2 class="title">{{ $carrousel->title }}</h2>

						<p class="content">{{ $carrousel->body }}</p>
					</div>
				</div>
				@endif				
				@endforeach						
			</div>
		</div>


		<div class="home-container">

			<section class="events">
				<h2 class="title-section">PRÓXIMOS EVENTOS</h2>
				@foreach ($latest_activities as $activity)	
				<article class="post">
					<h3 class="title"><a rel="bookmark" href="{{ route('activity', [$activity->slug, $activity->id]) }}">{{ $activity->title }}</a></h3>
					<span class="date">{{ date("M d, Y",strtotime($activity->date_begin)) }}</span>
					<span class="time">{{ $activity->time }}</span>
					<p class="content">{{ substr($activity->body,0,100).'...' }} <a rel="bookmark" href="{{ route('activity', [$activity->slug, $activity->id]) }}" class="more">VER MÁS</a>
					</p>
				</article>
				@endforeach				
			</section>

			<section class="news">
				<h2 class="title-section">ULTIMAS NOTICIAS</h2>
				@foreach ($latest_noticias as $noticia)	
				<?php $src = basename( $noticia->image_url ).PHP_EOL; 					
				$yearPath  = dirname( $noticia->image_url ).PHP_EOL;					
				$year      = basename( $yearPath ).PHP_EOL; ?>
				<article class="post">
					<h3 class="title"><a rel="bookmark" href="{{ route('noticia', [$noticia->slug, $noticia->id]) }}">{{ $noticia->title }}</a></h3>
					<span class="date">{{ $noticia->created_at->format('M d, Y') }}</span>
					<figure class="image">
						<a rel="bookmark" href="{{ route('noticia', [$noticia->slug, $noticia->id]) }}">
							<img src="{{ asset('image/'.$year.'/'.$src.'/180') }}" alt="{{ $noticia->title }}">
						</a>
					</figure>
					<p class="content">{{ substr( strip_tags($noticia->body), 0,100).'...' }} <a rel="bookmark" href="{{ route('noticia', [$noticia->slug, $noticia->id]) }}" class="more">VER MÁS</a>
					</p>
				</article>				
				@endforeach				
			</section>

			<div class="extra-container">
				
				{{--
				<div class="course-finder">
					<h2 class="title">BUSCADOR DE CURSOS</h2>
					<form action="#">
						<div>
							<input type="text" class="txb-find" />
							<button class="btn-find" type="submit">BUSCAR!</button>
						</div>						
						<span class="help-block">* Ingrese el ID, titulo o el nombre del profesor del curso</span>
					</form>
				</div> 
				--}}
		
				@include('layouts.useful_links')

				<div class="aula">
					<a href="{{ route('home') }}" class="aulavirtual" title="Aula virtual">
						<span class="play-circle"></span>
						<div class="text-area">
							<span class="text-title">AULA VIRTUAL</span>
							<span class="text-tagline">Ingresa y visualiza los recursos compartidos!</span>
						</div>
					</a>
					@if (!Auth::check())
					<a href="{{ route('login') }}" class="aulavirtual" title="Aula virtual">
						<span class="play-circle"></span>
						<div class="text-area">
							<span class="text-title">¿ERES ADMINISTRADOR?</span>
							<span class="text-tagline">Haz click aqui.</span>
						</div>
					</a>						
					@endif
				</div>		

			</div>
		</div>
	</div>

@stop