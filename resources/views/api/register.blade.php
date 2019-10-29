@extends('api.base')

@section('content_header', 'App registration')

@section('content')
	<form action="{{ route('api.clients.store') }}" method="post">
		@csrf

		<div class="form-group">
			<label for="name">App name</label>
			<input id="name" name="name" type="text" class="form-control">

			@error('name')
				<div class="alert alert-danger">{{ $message }}</div>			
			@enderror
		</div>

		<div class="form-group">
			<label for="redirect">Redirect URI</label>
			<input class="form-control" type="text" name="redirect" id="redirect">

			@error('redirect')
				<div class="alert alert-danger">{{ $message }}</div>			
			@enderror
		</div>

		<button type="submit" class="btn btn-success">
			Register
		</button>
	</form>
@endsection