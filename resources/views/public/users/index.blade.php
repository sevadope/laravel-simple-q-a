@extends('public.base')

@section('content_header', 'Users')

@section('content')

	<div class="d-flex flex-wrap">
		@foreach($users as $user)
			@include('public.components.user_card')
		@endforeach		
	</div>

	{{ $users->links() }}
@endsection

@section('right_sidebar')
	@component('public.components.toplist')
		@slot('toplist', $users_toplist)
		@slot('title', 'Most active users')
		@slot('component_path', 'public.components.mini_user_card')
	@endcomponent
@endsection