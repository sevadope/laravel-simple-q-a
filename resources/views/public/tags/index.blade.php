@extends('public.base')

@section('content_header', 'Tags')

@section('content')

	<div class="d-flex flex-wrap">
		@foreach($tags as $tag)
			@include('public.components.tag_card')
		@endforeach		
	</div>

	{{ $tags->links() }}
@endsection