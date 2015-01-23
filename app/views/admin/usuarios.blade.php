@extends('layouts.layout')

@section('title')
	Usuarios
@stop

@section('content')
	<div class="limit container">

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>	
				<li class="active">Usuarios</li>
			</ol>
		</div>

		<div class="events-container">			
			<div class="events- is-block">
		
				<h2 class="title-section">Usuarios</h2>				
				
				<section class="posts">					
					@foreach ($usuarios as $usuario)					
					<article class="post">
						
						<div class="pull-right">
							{{ Form::open(['route' => ['usuario_destroy', $usuario->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
								{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
							{{ Form::close() }}
						</div>

						<h3 class="title">{{{ $usuario->full_name }}}, <small>{{{ $usuario->email }}}</small></h3>

						<span class="date">{{{ date("M d, Y",strtotime($usuario->created_at)) }}}</span>
						<span class="time">{{{ $usuario->type }}}</span>		
										
						<p class="content">{{{ $usuario->password }}}</p>
					</article>
					@endforeach
				</section>

				{{ $usuarios->links() }}

			</div>			
		</div>

	</div>	
@stop