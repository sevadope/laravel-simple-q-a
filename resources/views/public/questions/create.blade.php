@extends('public.base')


@section('content_header', 'Ask Question')


@section('content')

<form method="post" action="{{ route('questions.store') }}">
	@csrf

	<div class="form-group">
		<label for="title">Title</label>

		<input class="form-control 
		@error('title') is_invalid @enderror"
		type="text" name="title"
		id="title">

		@error('title')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="form-group">
		<label for="tags">Tags</label>

		<select class="form-control" name="tags[]" id="tags" multiple>
			@foreach($tags as $tag)
				<option value="{{ $tag->id }}">
					{{ $tag->title }}
				</option>
			@endforeach
		</select>

		@error('tags')
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
	<button type="submit" class="btn btn-success">Update</button>
</form>

@endsection