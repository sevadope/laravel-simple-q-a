@extends('api.base')

@section('content_header', "Edit '$client->name' App")

@section('content')
	<form action="{{ route('api.clients.update', $client->getKey()) }}" method="post">
		@method('PATCH')
		@csrf

		<div class="form-group">
			<label for="name">App name</label>
			<input id="name" name="name" type="text" class="form-control"
			value="{{ $client->name }}">

			@error('name')
				<div class="alert alert-danger">{{ $message }}</div>			
			@enderror
		</div>

		<div class="form-group">
			<label for="redirect">Redirect URI</label>
			<input class="form-control" type="text" name="redirect" id="redirect"
			value="{{ $client->redirect }}">

			@error('redirect')
				<div class="alert alert-danger">{{ $message }}</div>			
			@enderror
		</div>

		<button type="submit" class="btn btn-success">
			Save changes
		</button>
	</form>
@endsection