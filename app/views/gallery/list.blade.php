@extends('layouts.layout')

@section('title')
	Galerias
@stop

@section('content')

	<div class="limit container">

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="active">Galersdsdias</li>
			</ol>
		</div>

		<div class="galleries-container">

			<div class="gallery-">

				@if (Auth::check())
					<div class="crud-container new-container">
						<div class="pull-right">
							<a href="{{ route('galeria_create') }}" class="btn btn-succes">Nueva galeria</a>
						</div>
					</div>
				@endif

				<h2 class="title-section">Galerias</h2>

				<div class="albums">
					@foreach ($galleries as $gallery)
						<div class="album">

							@if (Auth::check())
								<div class="crud-container">
									<div class="pull-right">
										<a href="{{ route('gallery', [$gallery->slug, $gallery->id]) }}" class="btn btn-info">Ver</a>
										<a href="{{ route('galeria_edit', [$gallery->id]) }}" class="btn btn-primary">Editar</a>

										{{ Form::open(['route' => ['galeria_destroy', $gallery->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
											{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
										{{ Form::close() }}
									</div>
								</div>
							@endif

							<?php $n = 0 ?>
							@foreach ($gallery->photos as $photo)
								<?php $n = $n + 1 ?>
							@endforeach

							<figure class="last-photo">
								<img src="{{{ asset( isset($gallery->photos->last()->image_url) ? $gallery->photos->last()->image_url : 'images/static/incotec.jpg' ) }}}" alt="{{{ asset( isset($gallery->photos->last()->title) ? $gallery->photos->last()->title : 'incotec' ) }}}">
							</figure>

							<div class="info">
								<div class="left">
									<span class="photos-num">{{ $n }}</span>
									<span class="photos-tag">FOTOS</span>
								</div>

								<div class="right">
									<h3 class="title">
										<a href="{{ route('gallery', [$gallery->slug, $gallery->id]) }}">{{ $gallery->title }}</a>
									</h3>

									<p class="description">{{ $gallery->body }}</p>
								</div>
							</div>

						</div>
					@endforeach
				</div>

				{{ $galleries->links() }}

			</div>

			<div class="extra-container">
				@include('layouts.useful_links')
				@include('layouts.noticias')
			</div>

		</div>
	</div>

@stop