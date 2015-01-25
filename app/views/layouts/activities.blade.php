<section class="events">
	<h2 class="title-section">PRÓXIMOS EVENTOS</h2>

	@foreach ($activities as $activity)
		<article class="post">
			<h3 class="title"><a href="{{ route('activity', [$activity->slug, $activity->id]) }}" rel="bookmark">{{ $activity->title }}</a></h3>

			<span class="date">{{ date("M d, Y",strtotime($activity->date_begin)) }}</span>
			<span class="time">{{ $activity->time }}</span>

			<p class="content">{{ content_preview($activity->body) }} <a href="{{ route('activity', [$activity->slug, $activity->id]) }}" class="more" rel="bookmark">VER MÁS</a>

			</p>
		</article>
	@endforeach
</section>



