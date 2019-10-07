@extends('layouts.base')

@section('brand_title', 'Toaster')

@section('left_sidebar')

	@auth
		<a class="cards-list-item"
		href="{{ route('questions.feed') }}">
			My feed
		</a>
	@endauth

	<a href="{{ route('questions.index') }}" class="cards-list-item">
		All questions
	</a>	

	<a href="{{ route('tags.index') }}" class="cards-list-item">
		All tags
	</a>	

	<a href="{{ route('users.index') }}" class="cards-list-item">
		Users
	</a>	

	@moderator
		<a class="cards-list-item"
		href="{{ route('admin.questions.index') }}">
			<button class="btn btn-primary"> To admin panel</button>
		</a>		
	@endmoderator

@endsection

@section('base_content')
	@include('public.components.messages.base')
	@yield('content')
@endsection

@section('sidebar_header')
	<a href="
	@auth {{ route('questions.create') }}
	@else {{ route('login') }}
	@endauth"
	class="btn btn-success">Ask a question</a>
@endsection