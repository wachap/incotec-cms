<div class="@yield('clase') links"> 
	<p class="title-widget">ULTIMAS CARRERAS</p>

	<ul class="list-links">
		@foreach ($cursos as $curso)	
		<li class="item-link"><a href="{{ route('course', [$curso->slug, $curso->id]) }}">{{ $curso->title }}</a></li>
		@endforeach
	</ul>
</div>



