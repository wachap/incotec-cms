@extends('layouts.layout')

@section('title')
	Nosotros
@stop

@section('content')
	<div class="limit container">

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="active">Institución</li>
			</ol>
		</div>

		<div class="nosotros-container">
			<div class="nosotros-">

				<figure class="nosotros-portada">
					<img src="{{ asset('images/static/incotec-nosotros.jpg') }}" alt="Incotec tacna" title="Incotec tacna" />
				</figure>

				<h1 class="title">Institución</h1>

				<p>INCOTEC es una institución que tiene por finalidad  de orientar y elevar el nivel académico  profesional  y laboral de toda la población  y así mejorar la calidad  de educación  de la niñez, juventud  y  adultos en general,  ya que  es el camino para alcanzar la modernización  que requiere nuestros pueblos  y el futuro del Perú  y así asegurar  que un buen porcentaje  de personas de escasos recursos económicos  se capacite.</p>

				<p>INCOTEC realiza convenios  con todas las UGELES de cada Región  para así otorgar  certificaciones con valor oficial; también cuenta con una oficina de bienestar social  el cual permite que la institución trabaje con un sistema de becas  integrales  que por medio  de las promotoras  llegan a las personas que cuentan con un nivel bajo en su economía, identificándose así  con todas las personas  y los pueblos  de nuestro país.</p>

				<div class="objetivos-container">
					<h3>Objetivo</h3>

					<p>Capacitar e incentivar a utilizar la computadora y programas de uso popular accesibles bajo entorno Windows realizando diversas tareas y manejando apropiadamente las herramientas de los programas básicos en el desarrollo de las capacidades en el ámbito educacional y empresarial de la región de Tacna.</p>
				</div>

				<div class="mv-container">

					<div class="vision">
						<h3>Visión</h3>

						<figure class="nosotros-portada">
							<img src="{{ asset('images/static/vision.jpg') }}" alt="Incotec visión" title="Incotec visión" />
						</figure>

						<p>Formar profesionales técnicos con principios y valores en diversas opciones laborales para la insercion y reinserción en el mercado laboral, mejorando su calidad de vida y contribuyendo al desarrollo de la comunidad y del pais. el Centro de Educación Técnico Productivo "INCOTEC", líder e incluyente con una educación crítica y comprometida con la formación de profesionales técnicos, innovadores, auto-gestores de actividades productivas y de servicios.</p>
					</div>

					<div class="mision">
						<h3>Misión</h3>

						<figure class="nosotros-portada">
							<img src="{{ asset('images/static/mision.jpg') }}" alt="Incotec mision" title="Incotec mision" />
						</figure>

						<p>El Centro de Educación Técnico Productivo " INCOTEC"", brinda educación integral a jóvenes y adultos preferentemente de los sectores de menos recursos económicos, con aporte del sistema preventivo: razón, religión y amor y prepara técnicamente en diversas opciones ocupacionales, como un medio importante para que generen autoempleo y mejoren la economía familiar.</p>
					</div>

				</div>

			</div>
		</div>

	</div>

@stop