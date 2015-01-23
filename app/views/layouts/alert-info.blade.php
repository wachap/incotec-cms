@if (Session::has('alert-info'))
	<div class="alert alert-info">
		{{ Session::get('alert-info') }}
	</div>
@endif