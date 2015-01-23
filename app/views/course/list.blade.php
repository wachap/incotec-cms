@extends('layouts.layout')

@section('title')
	Carreras
@stop

@section('content')
	<div class="container limit">	

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>		
				<li class="active">Carreras</li>
			</ol>
		</div>

		<div class="courses-container">	

			<div class="courses-">		

		@if (Auth::check())			

			<div class="crud-container new-container">
				<div class="pull-right">
					<a href="{{ route('carrera_create') }}" class="btn btn-succes">Nueva carrera</a>
				</div>
			</div>

		@endif		

				<h2 class="title-section">Carreras Disponibles</h2>

				<table class="table-courses">
					<thead>
						<tr>
							<th>#</th>
							<th>Titulo de la Carrera</th>
							<th>Grado</th>
						</tr>	
					</thead>

					<tbody>
						@foreach ($courses as $course)
						<tr>	
							<td class="fila">{{ $course->id }}</td>
							<td class="fila"><a href="{{ route('course', [$course->slug, $course->id]) }}">{{ $course->title }}</a></td>
							<td class="fila">{{ $course->course_level }}</td>

							@if (Auth::check())
							<td>
								<div class="crud-container">
									<div class="pull-right">
										<a href="{{ route('course', [$course->slug, $course->id]) }}" class="icon-view btn btn-info is-inline-block"></a>
										<a href="{{ route('carrera_edit', [$course->id]) }}" class="icon-edit btn btn-primary is-inline-block"></a>
										
										{{ Form::open(['route' => ['carrera_destroy', $course->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
											{{ Form::submit('', ['class' => 'btn btn-danger']) }}
											<div class="icon-delete"></div>
										{{ Form::close() }}
									</div>
								</div>
							</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>	

				{{ $courses->links() }}

			</div>

			<div class="extra-container">
				@include('layouts.activities')	
			</div>

		</div>

	</div>
@stop

