@extends('public.base')



@section('content_header', "Edit user $user->name")

@section('content')
	<div class="d-flex justify-content-start">
		<img class="large-icon mb-2" src="{{ asset('storage/'.$user->profile_image) }}" 
		alt="Profile image">
		<a href="{{ route('users.removeImage', $user->name) }}"
		class="remove-profile-image btn btn-link">Remove</a>			
	</div>

	<form action="{{ route('users.update', $user->name) }}"
	method="post" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		
		<div class="form-group">
			<input class="form-control-file" type="file"
			name="profile_image" id="profile_image">	
		</div>		

		<div class="form-group">
			<label for="name"></label>

			<input class="form-control" type="text" id="name"
			value="{{ $user->name }}" readonly>
		</div>

		<div class="form-row">
			<div class="col">
				<label for="first_name">First name</label>
				<input class="form-control @error('first_name') is_invalid @enderror"
				type="text" name="first_name" id="first_name" 
				value="{{ $user->first_name }}">

				@error('first_name')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="col">
				<label for="last_name">Last name</label>
				<input class="form-control @error('last_name') is_invalid @enderror"
				type="text" name="last_name" id="last_name" 
				value="{{ $user->last_name }}">

				@error('last_name')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<div class="form-group">
			<label for="briefly_about_myself">Briefly about myself</label>

			<input class="form-control 
			@error('briefly_about_myself') is_invalid @enderror"
			type="text" name="briefly_about_myself"
			id="briefly_about_myself" 
			value="{{ $user->briefly_about_myself }}">

			@error('briefly_about_myself')
				<div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="form-group">
			<label for="about_myself">About myself</label>

			<textarea class="form-control @error('about_myself') is_invalid @enderror"
			name="about_myself" id="about_myself" cols="30" rows="10"
			>{{ old('about_myself', $user->about_myself) }}</textarea>

			@error('about_myself')
				<div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<button type="submit" class="btn btn-success">Save</button>
	</form>
@endsection
