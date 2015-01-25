<section class="news">

	<h2 class="title-section">ULTIMAS NOTICIAS</h2>

	@foreach ($noticias as $noticia)
		<article class="post">
			<figure class="image">
				<a rel="bookmark" href="{{ route('noticia', [$noticia->slug, $noticia->id]) }}">
					<img src="{{ asset( get_urlImage($noticia->image_url, 150) ) }}" alt="{{ $noticia->title }}">
				</a>
			</figure>

			<span class="date">{{ $noticia->created_at->format('M d, Y') }}</span>

			<h3 class="title"><a rel="bookmark" href="{{ route('noticia', [$noticia->slug, $noticia->id]) }}">{{ $noticia->title }}</a></h3>

		</article>
	@endforeach

</section>





