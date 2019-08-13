@extends('admin.users.show.base')

@section('comments', 'active')

@section('tab_content')

	@component('admin.includes.comments_tab')
		@slot('item', $user)
	@endcomponent

@endsection