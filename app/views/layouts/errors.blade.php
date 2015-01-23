@if ( $errors->any() )
	<div class="alert alert-danger">      
		<strong>Por favor corrige los siguentes errores:</strong>
		<ul>
		@foreach ( $errors->all() as $message )
			<li>{{ $message }}</li>
		@endforeach
		</ul>
	</div>
@endif