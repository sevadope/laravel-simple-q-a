@section('right_sidebar')

<li class="list-group-item">
  <a class="btn btn-info" href="{{ $edit }}">Edit</a>
</li>

<form action="{{ $destroy }}" method="POST">
	@method('DELETE')
	@csrf

	<li class="list-group-item">
	  <button type="submit" class="btn btn-danger">Delete</button>
	</li>  	  

</form>
@endsection