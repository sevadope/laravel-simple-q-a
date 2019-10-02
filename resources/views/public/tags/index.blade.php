@extends('public.base')

@section('head')
	<script src="{{ asset('js/subscribe.js') }}" defer></script>
@endsection

@section('content_header', 'Tags')

@section('content')

	<div class="d-flex flex-wrap">
		@foreach($tags as $tag)
			@include('public.components.tag_card')
		@endforeach		
	</div>

	{{ $tags->links() }}
@endsection