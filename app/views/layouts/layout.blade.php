<!doctype html>

<html lang="es">

<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> @yield('title') | Incotec</title>	
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />	
	
	<meta name="description" content="Incotec es una institución que tiene por finalidad orientar y elevar el nivel académico profesional y laboral de toda la población y así mejorar la calidad de educación de la niñez, juventud y adultos en general." />

	<!-- begin og-tags -->
	@section('og-facebook')
	<meta property="og:description" content="Incotec es una institución que tiene por finalidad orientar y elevar el nivel académico profesional." />
	<meta property="og:title" content="Incotec"/>
	<meta property="og:image" content="{{ asset('images/static/incotec-nosotros.jpg') }}" />
	<meta property="og:type" content="website"/>
	<meta property="og:url" content="{{ asset('') }}" />
	@show	

	<meta property="og:site_name" content="Incotec" />
	<meta property="og:url" content="{{ asset('') }}" />
	<!-- end og-tags -->
	
	<!-- Estilos -->
	@section('style')
	{{ HTML::style('css/index.css'); }} 	
	@show
	<!-- end Estilos -->
	
	@yield('scripts-top')

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

	<!--[if lt IE 9]>

		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

	<![endif]-->
</head>

<body>
	<header>	
		@section('header')

			@if (Auth::check())
			<div class="limit-nav-top">	
				<div class="nav-top">
					<span class="text">Bienvenido administrador</span>

					<div class="item">
						<span class="user">{{ Auth::user()->full_name }}</span>

						<ul class="sub-menu">
							<li><a href="{{ route('account') }}">Editar perfil</a></li>

							@if ( Auth::user()->type == 'admin')
								<li><a href="{{ route('sign_up') }}">Crear usuario</a></li>
								<li><a href="{{ route('usuarios') }}">Ver usuarios</a></li>
							@endif							

							<li><a href="{{ route('logout') }}">Salir</a></li>
						</ul>
					</div>
				</div>
			</div>
			@else

			@endif			

			<div class="limit">

				<figure class="logo">
					<a href="{{ route('home') }}">
						<img src="{{ asset('images/static/logo.jpg') }}" alt="Incotec" />
					</a>
				</figure>

				<nav class="menu">
					<ul class="list">
						<li class="item"><a class="title-link" href="{{ route('noticias') }}">Noticias<span class="sub-title">Ultimas Noticias</span></a></li>
						<li class="item"><a class="title-link" href="{{ route('activities') }}">Eventos<span class="sub-title">Próximos Eventos</span></a></li>
						<li class="item"><a class="title-link" href="{{ route('courses') }}">Carreras<span class="sub-title">Carreras Disponibles</span></a></li>
						<li class="item">
							<a class="title-link" href="{{ route('incotec') }}">Nosotros<span class="sub-title">Como funciona las cosas</span></a>

							<ul class="sub-menu">
								<li><a href="{{ route('galleries') }}">Galerias</a></li>
								<li><a href="{{ route('leadership') }}">Plana Administrativa</a></li>
							</ul>
						</li>
						<li class="item"><a class="title-link" href="{{ route('contact') }}">Contacto<span class="sub-title">Contáctanos</span></a></li>
					</ul>
				</nav>

				<input id="mobile-nav-switch" name="check-nav" type="checkbox" />
				<label class="lbl-check-nav" for="mobile-nav-switch"><span></span></label>

				<div class="movile-menu">
					<ul class="list">
						<li class="item"><a href="{{ route('noticias') }}">Noticias</a></li>
						<li class="item"><a href="{{ route('activities')  }}">Eventos</a></li>
						<li class="item"><a href="{{ route('courses') }}">Carreras</a></li>

						<li class="item">
							<a class="title-link" href="{{ route('incotec') }}">Nosotros</a>

							<ul class="sub-mobile-menu">
								<li><a href="{{ route('galleries') }}">Galerias</a></li>
								<li><a href="{{ route('leadership') }}">Plana Administrativa</a></li>
							</ul>
						</li>

						<li class="item"><a href="{{ route('contact') }}">Contacto</a></li>
					</ul>
				</div>
			</div>

			@show

	</header>

	@yield('content')

	<footer>
		@section('footer')

			@unless (Auth::check() )
			<div class="limit">

				@section('clase')widget @stop
				@include('layouts.useful_links')

				<div class="widget contact">
					<p class="title-widget">INFORMACIÓN DE CONTACTO</p>
					<p class="contact-subject">INCOTEC</p>

					<div class="contact-address">
						<span class="contact-street">Av. Leguia 1369 (Frente al paseo de las aguas)</span>
						<span class="contact-city-region">Peru, Tacna</span>
						<span class="contact-zip">TACNA 052</span>
					</div>

					<div class="contact-tel">
						<span class="tel">TEL:</span>
						<span class="tel-number">42-47-68</span>
					</div>

					<div class="social-icons">
						<ul class="list-social">
							<li><a href="mailto:incotec@gmail.com" title="escribenos" class="item-social mail icon-envelope"></a></li>
							<li><a target="_blank" href="http://www.twitter.com" class="item-social twitter icon-twitter"></a></li>
							<li><a target="_blank" href="https://www.facebook.com/incotec.tacna.7" class="item-social facebook icon-facebook"></a></li>
						</ul>
					</div>
				</div>

				<div class="widget gallery">
					<p class="title-widget">GALERIA</p>

					<ul class="list-gallery">
						@foreach ($latest_photos as $photo)

						<li class="item-gallery">
							<?php $src = basename( $photo->image_url ).PHP_EOL;									
							$yearPath  = dirname( $photo->image_url ).PHP_EOL;									
							$year      = basename( $yearPath ).PHP_EOL; ?>  

							<a href="{{ route('gallery', [$photo->gallery->slug, $photo->gallery_id]) }}">
								<img src="{{ asset('image/'.$year.'/'.$src.'/150') }}"  alt="{{ $photo->title }}" />
							</a>
						</li>

						@endforeach
					</ul>
				</div>

			</div>
			@endunless

			<div class="copyright">
				<div class="limit">
					<p>&copy;2015 Desarrollado por <a class="by" target="_blank" href="https://www.facebook.com/nwochap">Gean Carlos</a> y <a class="by" target="_blank" href="https://www.facebook.com/roxsy.velasquez">Roxsy</a>.</p>
				</div>
			</div>	

		@show

	

	</footer>

	<!--{{HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');}}-->

	@yield('scripts-bottom')
</body>

</html>