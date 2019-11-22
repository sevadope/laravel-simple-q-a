@extends('api.base')

@section('content_header', 'API')

@section('content')
	<h3>Introduction</h3>
	<p>
		This API implements OAuth 2.0.
	</p>
	<p>
		Firstly, you need to <a href="{{ route('api.clients.register') }}">register your app</a>.
	</p>
@endsection