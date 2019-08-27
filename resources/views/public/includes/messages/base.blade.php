@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session('success') }}
		
		@if(session()->has('restore_route'))
			<form method="POST" action="{{ session('restore_route') }}">
				@csrf
				<button class="btn btn-link" type="submit">Click to restore</button>	
			</form>
		@endif

	</div>
@endif

@if($errors->has('msg'))
	<div class="alert alert-danger">
			@foreach($errors->all() as $error)
				{{ $error }}
			@endforeach
	</div>	
@endif