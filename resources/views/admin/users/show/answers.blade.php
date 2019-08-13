@extends('admin.users.show.base')

@section('answers', 'active')

@section('tab_content')

	@component('admin.includes.answers_tab')
		@slot('item', $user)
	@endcomponent

@endsection