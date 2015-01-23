@extends('layouts.layout')

@section('title')
	Mensajes
@stop

@section('content')
<div class="limit container">

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>	
				<li class="active">Mensajes</li>
			</ol>
		</div>

		<div class="events-container">			
			<div class="events- is-block">
		
				<h2 class="title-section">Mensajes</h2>	

				<section class="posts">					
					@foreach ($mensajes as $mensaje)						
					<article class="post">						
						<div class="pull-right">
							{{ Form::open(['route' => ['contact_destroy', $mensaje->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
								{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
							{{ Form::close() }}
						</div>

						<h3 class="title">{{{ $mensaje->full_name }}}, <small>{{{ $mensaje->message_subject }}}</small></h3>

						<span class="date">{{{ date("M d, Y",strtotime($mensaje->created_at)) }}}</span>
						<span class="time">{{{ $mensaje->email }}}</span>
						<span class="time">{{{ $mensaje->phone }}}</span>
						
						<p class="content">{{{ $mensaje->message }}}</p>
					</article>
					@endforeach
				</section>

				{{ $mensajes->links() }}

			</div>			
		</div>

	</div>	
@stop

