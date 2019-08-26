@extends('admin.users.show.base')

@section('comments', 'active')

@section('tab_content')



	<h3>Comments:</h3>

	@include('admin.includes.comments_table')

	{{ $comments->links() }}

@endsection