@extends('layouts.layout')

@section('title')
	Plana-Administrativa
@stop

@section('content')
	<div class="limit container">

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="active">Plana administrativa</li>
			</ol>
		</div>

		<div class="leadership-container">

			<div class="leadership-">

				@if (Auth::check())	
					<div class="crud-container new-container">
						<div class="pull-right">
							<a href="{{ route('leader_create') }}" class="btn btn-succes">Nuevo trabajador</a>
						</div>
					</div>
				@endif

				<h2 class="title-section">School LeaderShip</h2>

				<div class="leaders">

					@if (Session::has('confirm'))
						<div class="alert alert-success ">
							{{ Session::get('confirm') }}
						</div>      
					@endif

					<h3 class="subtitle">Director</h3>

					@foreach ($directores as $director)
						<div class="leader">

							@if (Auth::check())
								<div class="crud-container">
									<div class="pull-right">
										<a href="{{ route('leader_edit', [$director->id]) }}" class="btn btn-primary">Editar</a>

										{{ Form::open(['route' => ['leader_destroy', $director->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
											{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
										{{ Form::close() }}
									</div>
								</div>
							@endif

							<figure class="photo">
								<?php $src = basename( $director->image_url ).PHP_EOL;
								$yearPath  = dirname( $director->image_url ).PHP_EOL;
								$year      = basename( $yearPath ).PHP_EOL; ?>

								<img src="{{ asset( $director->image_url ) }}" alt="{{ $director->full_name }}" />
							</figure>

							<div class="info-content">	
								<div class="info">
									<h4 class="title">{{ $director->full_name }}, <small>{{ $director->job_type }}</small> </h4>

									<p class="leader-position">Miembro del equipo administrativo desde {{ date("F Y", strtotime( $director->since )) }} </p>
								</div>

								<p>{{ $director->body }}</p>
							</div>

						</div>
					@endforeach

					<h3 class="subtitle">Profesores</h3>

					@foreach ($profesores as $profesor)
						<div class="leader">

							@if (Auth::check())
								<div class="crud-container">
									<div class="pull-right">
										<a href="{{ route('leader_edit', [$profesor->id]) }}" class="btn btn-primary">Editar</a>

										{{ Form::open(['route' => ['leader_destroy', $profesor->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
											{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
										{{ Form::close() }}
									</div>
								</div>
							@endif

							<figure class="photo">
								<img src="{{ asset($profesor->image_url) }}" alt="{{ $profesor->full_name }}" />
							</figure>

							<div class="info-content">
								<div class="info">
									<h4 class="title">{{ $profesor->full_name }}, <small>{{ $profesor->job_type }}</small> </h4>

									<p class="leader-position">Miembro del equipo académico desde {{ date("F Y", strtotime( $profesor->since )) }} </p>
								</div>

								<p>{{ $profesor->body }}</p>
							</div>
						</div>
					@endforeach

					<h3 class="subtitle">Secretarias</h3>

					@foreach ($secretarias as $secretaria)
						<div class="leader">

							@if (Auth::check())
								<div class="crud-container">
									<div class="pull-right">
										<a href="{{ route('leader_edit', [$secretaria->id]) }}" class="btn btn-primary">Editar</a>

										{{ Form::open(['route' => ['leader_destroy', $secretaria->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
											{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
										{{ Form::close() }}
									</div>
								</div>
							@endif

							<figure class="photo">
								<img src="{{ asset($secretaria->image_url) }}" alt="{{ $secretaria->full_name }}" />
							</figure>

							<div class="info-content">	
								<div class="info">
									<h4 class="title">{{ $secretaria->full_name }}, <small>{{ $secretaria->job_type }}</small> </h4>

									<p class="leader-position">Miembro del equipo administrativo desde {{ date("F Y", strtotime( $secretaria->since )) }} </p>
								</div>

								<p>{{ $secretaria->body }}</p>
							</div>
						</div>
					@endforeach

				</div>

			</div>

			<div class="extra-container">
				@include('layouts.useful_links')					
				@include('layouts.noticias')
			</div>	

		</div>

</div>


@stop