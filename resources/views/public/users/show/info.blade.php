@extends('public.users.show.base')

@section('info', 'active')

@section('tab_content')

	<h4>
		{{ $user->about_myself ?? 'This user has not told anything about himself' }}
	</h4>

@endsection