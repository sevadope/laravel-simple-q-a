<div class="ml-2">

	@foreach($tabs as $query_string => $title)
		<a href="{{ url()->current() }}/?tab={{ $query_string }}" 
		class="btn btn-outline-secondary 
		{{ $query_string == $param ? 'active' : '' }}">
			{{ $title }}
		</a>
	@endforeach

</div>