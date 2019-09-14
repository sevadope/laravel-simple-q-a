@extends('admin.users.show.base')

@section('answers', 'active')

@section('tab_content')

	@if($answers->isNotEmpty())
		<h3>Answers:</h3>
		@include('admin.components.answers_table')
		{{ $answers->links() }}
	@else
		<h3>This user has no answers yet</h3>
	@endif	

@endsection