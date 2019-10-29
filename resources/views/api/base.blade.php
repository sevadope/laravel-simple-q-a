@extends('layouts.base')

@section('brand_title', 'Site API')

@section('left_sidebar')
	<a href="{{ route('api.intro') }}" class="cards-list-item">Getting started</a>
	<a href="{{ route('api.apps', auth()->user()->name) }}" class="cards-list-item">My apps</a>	
@endsection
