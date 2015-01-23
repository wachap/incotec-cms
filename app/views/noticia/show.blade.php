@extends('layouts.layout')

@section('title')
	{{ $noticia->title }}
@stop

@section('og-facebook')
	<?php 	$OgDesc 		= substr( strip_tags( $noticia->body ), 0, 150 );
			$OgDescFinal    = str_replace(chr(13),"",$OgDesc); ?>
	<meta property="og:description" content="{{ str_replace([chr(10), '&nbsp;'],' ',$OgDescFinal) }}" />
	<meta property="og:title" content="{{ $noticia->title }}"/>
	<meta property="og:image" content="{{ asset( $noticia->image_url ) }}" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="{{ asset( 'index.php/noticia/'.$noticia->slug.'/'.$noticia->id ) }}" />
@stop

@section('content')
	<div class="container limit">		

		<div class="breadcrumbs">
			<ol class="list">
				<li class="link"><a href="{{ route('home') }}">Home</a></li>
				<li class="link"><a href="{{ route('noticias') }}">Noticias</a></li>
				<li class="active">{{ $noticia->title }}</li>
			</ol>
		</div>

		<div class="news-single-container">
			<div class="news-single">

				<article>

				@if ( Session::has('confirm') )
					<div class="alert alert-success ">
						{{ Session::get('confirm') }}
					</div>      
				@endif

				@if ( Auth::check() )
					<div class="crud-container">
						<div class="pull-right">
							<a href="{{ route('noticias') }}" class="btn btn-info">Lista</a>
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
					<img src="{{ asset( $noticia->image_url ) }}" alt="$noticia->title">
				</figure>

				<h1 class="title">{{ $noticia->title }}</h1>

				<div class="info">
					<span class="date">{{ $noticia->created_at->format('M d, Y') }}</span>
					<span class="category">Noticias</span>

					<!-- DISQUS # COMENTARIOS -->
					<span class="comments disqus-comment-count" data-disqus-url=" {{ asset('index.php/noticia/'.$noticia->slug.'/'.$noticia->id) }} "> # Comentarios</span>
					<!-- DISQUS # COMENTARIOS -->
				</div>

				<div class="body" >{{ $noticia->body }}</div>				
					
				</article>

				<div class="comentarios" >
			   		<div id="disqus_thread"></div>				    
				</div>

			</div>

			<div class="extra-container">
				@include('layouts.useful_links')
				@include('layouts.activities')	
			</div>

		</div>
	</div>
	
	{{-- DISQUS START --}}
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
	<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'incotec'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
	</script>
	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	{{-- DISQUS END --}}

@stop