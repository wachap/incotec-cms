@extends('layouts.layout')

@section('title')
	Noticias
@stop

@section('scripts-bottom')
	<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'incotec'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
    </script>
@stop

@section('content')
	<div class="limit container">
		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="active">Noticias</li>
			</ol>
		</div>

		<div class="news-container">

			<div class="news-">

				@if ( Auth::check() )
					<div class="crud-container new-container">
						<div class="pull-right">
							<a href="{{ route('noticia_create') }}" class="btn btn-succes">Nueva noticia</a>
						</div>
					</div>
				@endif			 	

				<h2 class="title-section">Noticias</h2>

				<p class="content-section">Todas las noticias referentes a nuestra institución. </p>

				<section class="posts" style="width: 100%;" >
					@foreach ($noticias as $noticia)
						<article class="post">

							@if ( Auth::check() )
								<div class="crud-container">
									<div class="pull-right">
										<a href="{{ route('noticia', [$noticia->slug, $noticia->id]) }}" class="btn btn-info">Ver</a>
										<a href="{{ route('noticia_edit', [$noticia->id]) }}" class="btn btn-primary">Editar</a>

										{{ Form::open(['route' => ['noticia_destroy', $noticia->id], 'method' => 'delete', 'class' => 'is-inline-block']) }}
											{{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
										{{ Form::close() }}
									</div>
								</div>
							@endif

							<?php $src = basename( $noticia->image_url ).PHP_EOL; 
							$yearPath  = dirname( $noticia->image_url ).PHP_EOL;
							$year      = basename( $yearPath ).PHP_EOL; ?>

							<figure class="image">
								<img src="{{ asset('image/'.$year.'/'.$src.'/300') }}" alt="{{ $noticia->title }}">
							</figure>

							<h3 class="title"><a href="{{ route('noticia', [$noticia->slug, $noticia->id]) }}" rel="bookmark">{{ $noticia->title }}</a></h3>

							<div class="datails">
								<span class="date">{{ $noticia->created_at->format('M d, Y') }}</span>
								<span class="category">Noticia</span>
								
								<!--  DISQUS COMENTARIOS  -->
								<span class="comments disqus-comment-count" data-disqus-url=" {{ asset('index.php/noticia/'.$noticia->slug.'/'.$noticia->id) }} "> # Comentarios</span>					
							</div>

							<p class="content">{{ substr( strip_tags($noticia->body), 0,100).'...' }} <a rel="bookmark" href="{{ route('noticia', [$noticia->slug, $noticia->id]) }}" class="more">VER MÁS</a></p>

						</article>
					@endforeach
				</section>

				{{ $noticias->links() }}

			</div>

			<div class="extra-container">	
				@include('layouts.useful_links')
				@include('layouts.activities')	
			</div>

		</div>
	</div>

@stop