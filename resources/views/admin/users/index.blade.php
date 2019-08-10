@extends('admin.base')



@section('content_header', 'Users')

@section('content')
<table class="table">
  	<thead>
    	<tr>
	      <th scope="col">#</th>
	      <th scope="col">Namdsfdsfe</th>
	      <th scope="col">Email</th>
	      <th scope="col">Signed up at</th>
    	</tr>
  	</thead>
	<tbody>
	@foreach($users as $item)
        <tr>
        	<th scope="row">{{ $item->id }}</th>
        	<td>
                <a href="{{ route('admin.users.info', $item->name) }}">
                    {{ $item->name }}
                </a>
            </td>
        	<td>{{ $item->email }}</td>
        	<td>{{ $item->created_at }}</td>
        </tr>
	@endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection