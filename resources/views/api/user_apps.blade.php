@extends('api.base')

@section('content_header', 'Your apps')

@section('content')
	@if($clients->isEmpty())
		<h5 class="mt-3">You don't have any apps. You can register your first app
			<a href="{{ route('api.register') }}">here</a>.
		</h5>
	@else
		<ul class="cards-list">
			@foreach($clients as $client)
				@include('api.components.client_card')
			@endforeach
		</ul>
	@endempty
@endsection