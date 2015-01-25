@extends('layouts.layout')

@section('title')
	Eventos
@stop

@section('content')
	<div class="limit container">

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="active">Eventos</li>
			</ol>
		</div>

		<div class="events-container">
			<div class="events-">

			@include('layouts.alert-warning')

			@if (Auth::check())
				<div class="crud-container new-container">
					<div class="pull-right">
						<a href="{{ route('evento_create') }}" class="btn btn-succes">Nuevo evento</a>
					</div>
				</div>
			@endif

				<h2 class="title-section">Próximos Eventos</h2>

				<section class="posts">

				@foreach ($activities as $activity)
					<article class="post">

					@if (Auth::check())
						<div class="crud-container">
							<div class="pull-right">

								<a href="{{ route('activity', [$activity->slug, $activity->id]) }}" class="btn btn-info">Ver</a>
								<a href="{{ route('evento_edit', [$activity->id]) }}" class="btn btn-primary">Editar</a>

								{{ Form::open(['route' => ['evento_destroy', $activity->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
									{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
								{{ Form::close() }}
							</div>
						</div>
					@endif

						<h3 class="title"><a rel="bookmark" href="{{ route('activity', [$activity->slug, $activity->id]) }}">{{ $activity->title }}</a></h3>

						<span class="date">{{ date("M d, Y",strtotime($activity->date_begin)) }}</span>
						<span class="time">{{ $activity->time }}</span>

						<p class="content">{{ content_preview($activity->body) }}<a rel="bookmark" href="{{ route('activity', [$activity->slug, $activity->id]) }}" class="more"> VER MÁS</a>
						</p>

					</article>
				@endforeach

				</section>

				{{ $activities->links() }}

			</div>

			<div class="extra-container">
				@include('layouts.useful_links')
				@include('layouts.noticias')
			</div>
		</div>

	</div>
@stop