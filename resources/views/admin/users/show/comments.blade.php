@extends('admin.users.show.base')

@section('comments', 'active')

@section('tab_content')

	@if($comments->isNotEmpty())
		<h3>Comments:</h3>
		@include('admin.components.comments_table')
		{{ $comments->links() }}
	@else
		<h3>This user has not yet commented on anything</h3>
	@endif	

@endsection