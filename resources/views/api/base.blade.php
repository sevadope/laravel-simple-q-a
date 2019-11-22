@extends('layouts.base')

@section('brand_title', 'Site API')

@section('left_sidebar')
	<a href="{{ route('api.intro') }}" class="cards-list-item">
		Getting started
	</a>
	<a href="{{ route('api.clients.list', auth()->user()->name) }}" class="cards-list-item">
		My apps
	</a>	
	<a href="{{ route('questions.feed') }}" class="cards-list-item">
		To site
	</a>		
@endsection
