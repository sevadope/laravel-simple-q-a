@extends('admin.users.show.base')

@section('answers', 'active')

@section('tab_content')

	<h3>Answers:</h3>

	@include('admin.includes.answers_table')

	{{ $answers->links() }}
@endsection