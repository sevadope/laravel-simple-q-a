@extends('admin.base')


@section('content_header', 'Edit question')


@section('content')

<form method="post" action="{{ route('admin.questions.update', $question->id) }}">
	@method('PATCH')
	@csrf

	<div class="form-group">
		<label for="title">Title</label>

		<input class="form-control 
		@error('title') is_invalid @enderror"
		type="text" name="title"
		id="title" 
		value="{{ $question->title }}">

		@error('title')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="form-group">
		<label for="tags">Tags</label>

		<select class="form-control" name="tags[]" id="tags" multiple>
			@foreach($tags as $tag)
				<option value="{{ $tag->id }}" {{ $question->tags->contains($tag->id) ? 'selected' : ''}}>
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
		>{{ old('description', $question->description) }}</textarea>

		@error('description')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<button type="submit" class="btn btn-success">Update</button>

</form>

@endsection

@section('right_sidebar')
	<li class="list-group-item">
	  <a class="btn btn-info" href="{{ route('admin.questions.show', $question->id) }}">Show</a>
	</li>

	<form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST">
		@method('DELETE')
		@csrf

		<li class="list-group-item">
		  <button type="submit" class="btn btn-danger">Delete</button>
		</li>  	  

	</form>
@endsection
