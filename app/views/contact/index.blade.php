@extends('layouts.layout')

@section('title')
	Contacto
@stop

@section('scripts-bottom')
<script src="http://maps.google.com/maps/api/js?sensor=false&callback=init" ></script>

<script type="text/javascript">
	var map;	
	var marker;

	function init()
	{	
		var image = new google.maps.MarkerImage
		(
			'http://www.crisservis.com/images/puertavigil.jpg',
			new google.maps.Size(30,28)
		);

		var mapOptions = 
		{
			center: new google.maps.LatLng(-18.0057498,-70.24184),
			zoom: 15,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}

		map       = new google.maps.Map(document.getElementById("map"),mapOptions);	
		var place = new google.maps.LatLng(-18.0057498,-70.24184);
		marker    = new google.maps.Marker

		({
			position: place,
			title: "Incotec",
			map: map
			// icon: image
		});

		google.maps.event.addListener(marker,"click",showInfo);
	}

	function showInfo()
	{
		map.setZoom(16);
		map.setCenter(marker.getPosition());
		var infowindow = new google.maps.InfoWindow
		({
			content: "Incotec"
		});
		infowindow.open(map.marker);
	}
</script>

@stop

@section('content')
	<div class="limit container">

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="active">Contacto</li>
			</ol>
		</div>
		
		<div class="contact-us-container">
			<div class="contact-us-">

			@if (Session::has('confirm'))
				<div class="alert alert-success ">
					{{ Session::get('confirm') }}
				</div>      
			@endif

				@include('layouts.errors')

				<div class="gmap">
					<div id="map"></div>
				</div>

			@if (Auth::check())	
				<div class="pull-right">
					<a href="{{ route('contact_list') }}" class="btn btn-info">Ver mensajes</a>
				</div>
			@endif	

				<h1 class="title">Contáctanos</h1>

				<p>INCOTEC es una institución que tiene por finalidad  de orientar y elevar el nivel académico  profesional  y laboral de toda la población  y así mejorar la calidad  de educación  de la niñez, juventud  y  adultos en general,  ya que  es el camino para alcanzar la modernización  que requiere nuestros pueblos  y el futuro del Perú  y así asegurar  que un buen porcentaje  de personas de escasos recursos económicos  se capacite.</p>

				<div class="sucursales">
					<div class="left">
						<h3>Tacna</h3>
						<p class="small">Tel: 424768 | AV. Leguia 1369</p>
						<h3>Ilo</h3>
						<p class="small">Tel: - | Jr. Calle Mirave Nº 643</p>		
					</div>

					<div class="left">
						<h3>Moquegua</h3>
						<p class="small">Tel: - | Calle Ayacucho Nº 411</p>
						<h3>Puno</h3>
						<p class="small">Tel: - | Jr. Lambayeque Nº 283</p>			
					</div>
				</div>

				<div class="form">

					<h3 class="form-title">Envíanos una nota</h3>

					{{ Form::open( ['route' => 'contact_store', 'method' => 'POST', 'role' => 'form', 'onsubmit' => 'btnSubmit.disabled() = true; return true;'] ) }}

					<div class="form-content name">
						{{ Form::label('full_name', 'Titulo', ['class' => 'form-label']) }}
						{{ Form::text('full_name', null, ['class' => 'form-control', 'required'=>'true', 'placeholder' => 'Ingrese su nombre']) }}
					</div>

					<div class="form-content phone">
						{{ Form::label('phone', 'Numero celular', ['class' => 'form-label']) }}
						{{ Form::text('phone', null, ['class' => 'form-control', 'required'=>'true', 'placeholder' => 'Ingrese su numero telefonico']) }}
					</div>

					<div class="form-content mail">
						{{ Form::label('phone', 'Correo electronico', ['class' => 'form-label']) }}
						{{ Form::email('email', null, array('placeholder'=>'Ingrese el email','class'=>'form-control', 'required'=>'true')) }}
					</div>

					<div class="form-content select">
						{{ Form::label('message_subject', 'Asunto', ['class' => 'form-label']) }}
						{{ Form::select('message_subject', [ 'dudas' => 'Dudas', 'informacion_de_la_carrera' => 'Informacion de la carrera', 'sugerencia_de_mejora' => 'Sugerencia de mejora' ], null, ['class' => 'form-control ', 'required'=>'true'] ) }}
					</div>

					<div class="form-content message">
						{{ Form::label('message', 'Mensaje', ['class' => 'form-label']) }}
						{{ Form::textarea("message", null, ['class' => 'form-control', 'required' => 'true']) }}	
					</div>

					<div class="form-content submit">
						{{ Form::submit('ENVIAR MENSAJE', ['id' =>'btnSubmit', 'name' => 'btnSubmit']) }}
					</div>	

					{{ Form::close() }}				

				</div>

			</div>

			<div class="extra-container">
				@include('layouts.useful_links')
				@include('layouts.noticias')	
			</div>

		</div>

	</div>
	
	<script type="text/javascript" charset="utf-8" async defer>
		function deshabilitarBtn () 
		{
			document.getElementById('btnSubmit').disabled=true;
		}
	</script>
@stop