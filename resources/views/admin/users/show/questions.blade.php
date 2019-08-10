@extends('admin.users.show.base')

@section('questions', 'active')

@section('tab_content')

	@foreach($user->questions as $question)
		<div class="card">
			<div class="card-body">
		  		<h6 class="card-subtitle mb-2 text-muted">*tagsTitle*</h6>
		    	<h5 class="card-title">{{ $question->title }}</h5>
		    	<h6 class="card-subtitle mb-2 text-muted">*subs+time*</h6>
		  	</div>
		</div>
	@endforeach

@endsection