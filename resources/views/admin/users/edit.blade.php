@extends('admin.base')

@section('content_header', 'User Edit')

@section('content')

<h3>{{ $user->name }}</h3>
<h4 class="d-inline">{{ $user->first_name }}</h4>
<h4 class="d-inline">{{ $user->last_name }}</h4>

@if($errors->any())
<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
</div>
@endif

<form action="{{ route('admin.users.update', $user->name) }}"
method="post">
	@method('PATCH')
	@csrf
	<label for="name"></label>
	<input class="form-control" type="text" id="name" value="{{ $user->name }}" readonly>

	<div class="form-row">
		<div class="col">
			<label for="first_name">First name</label>
			<input type="text" name="first_name" id="first_name" class="form-control"
			value="{{ $user->first_name }}">
		</div>
		<div class="col">
			<label for="last_name">Last name</label>
			<input type="text" name="last_name" id="last_name" class="form-control"
			 value="{{ $user->last_name }}">
		</div>
	</div>

	<div class="form-group">
		<label for="briefly_about_myself">Briefly about myself</label>

		<input class="form-control" type="text" name="briefly_about_myself"
		id="briefly_about_myself" 
		value="{{ $user->briefly_about_myself }}">
	</div>

	<div class="form-group">
		<label for="about_myself">About myself</label>

		<textarea class="form-control" name="about_myself" id="about_myself" cols="30" rows="10"
		>{{ old('about_myself', $user->about_myself) }}</textarea>
	</div>

	<button type="submit" class="btn btn-success">Save</button>
</form>
@endsection