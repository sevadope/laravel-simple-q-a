@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
@endif

@if($errors->has('msg'))
	<div class="alert alert-danger">
			@foreach($errors->all() as $error)
				{{ $error }}
			@endforeach
	</div>	
@endif