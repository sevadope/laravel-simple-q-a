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

@section('right_sidebar')
	@isset($tags_toplist)
		@component('public.components.toplist')
			@slot('toplist', $tags_toplist)
			@slot('title', 'Popular tags of the day')
			@slot('component_path', 'public.components.mini_tag_card')
		@endcomponent
	@endisset
@endsection