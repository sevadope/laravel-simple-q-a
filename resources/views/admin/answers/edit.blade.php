@extends('admin.base')

@section('content_header', "Edit answer with ID '$answer->id'")

@section('content')

<form action="{{ route('admin.answers.update', $answer->id) }}" method="POST">
	@method('PATCH')
	@csrf

	<h3><a href="{{ route('admin.users.info', $answer->user->name) }}">{{ $answer->user->profileName }}</a></h3>

	<div class="form-group">
		<label for="body">Body</label>

		<textarea class="form-control @error('body') is_invalid @enderror"
		name="body" id="body" cols="30" rows="10"
		required>{{ old('body', $answer->body) }}</textarea>

		@error('body')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<button type="submit" class="btn btn-success">Update</button>

</form>

@endsection

@section('right_sidebar')

	<form action="{{ route('admin.answers.destroy', $answer->id) }}" method="POST">
		@method('DELETE')
		@csrf
		<li class="cards-list-item">
		  <button type="submit" class="btn btn-danger">Delete</button>
		</li>  	  
	</form>

@endsection