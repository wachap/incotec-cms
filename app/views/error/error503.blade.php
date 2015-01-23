@extends('layouts.layout')

@section('title')
	503 Error  
@stop

@section('content')

	<div class="container limit">
		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="active">503 Error</li>
			</ol>
		</div>

		<div class="nosotros-container">
			<div class="nosotros-">
				<h1 class="title-404">503 Error</h1>

				<figure class="image-404">
					<img src="{{ asset( 'images/static/404.png' ) }}" alt="503 Error" />
				</figure>

				<span><strong>OOOPS!</strong></span>

				<p class="message-404">¡Qué vergonzosa situación!, la página solicitada no se encuentra o no existe.</p>
			</div>
		</div>
	</div>

@stop 