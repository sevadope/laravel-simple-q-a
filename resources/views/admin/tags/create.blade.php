@extends('admin.base')



@section('content_header', 'Create new tag')

@section('content')

<form method="post" action="{{ route('admin.tags.store') }}">
	@csrf

	<div class="form-group">
		<label for="title">Title</label>

		<input class="form-control 
		@error('title') is_invalid @enderror"
		type="text" name="title" id="title" value="{{ old('title') }}">

		@error('title')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="form-group">
		<label for="slug">Slug</label>

		<input class="form-control 
		@error('slug') is_invalid @enderror"
		type="text" name="slug" id="slug" value="{{ old('slug') }}">

		@error('slug')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="form-group">
		<label for="description">Description</label>

		<textarea class="form-control @error('description') is_invalid @enderror"
		name="description" id="description" cols="30" rows="10"
		>{{ old('description') }}</textarea>

		@error('description')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>
	<button type="submit" class="btn btn-success">Create</button>
</form>

@endsection
