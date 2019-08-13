@extends('admin.base')



@section('content_header')
<div class="d-flex justify-content-between">
    <div class="">
        Questions
    </div>
    <a href="{{ route('admin.questions.create') }}" class="btn btn-success">
        New
    </a>
</div>
@endsection

@section('content')

@include('admin.includes.messages.base')

<table class="table">

  	<thead>
    	<tr>
	      <th scope="col">#</th>
	      <th scope="col">Author</th>
	      <th scope="col">Title</th>
	      <th scope="col">Published at</th>
    	</tr>
  	</thead>
    
	<tbody>
	@foreach($questions as $item)
	
    <tr>
    	<th scope="row">{{ $item->id }}</th>
    	<td>{{ $item->user->name }}</td>
    	<td>
    		<a href="{{ route('admin.questions.show', $item->id) }}">
    			{{ $item->title }}
    		</a>
    	</td>
    	<td>{{ $item->created_at }}</td>
    </tr>

	@endforeach
  </tbody>
</table>

{{ $questions->links() }}

@endsection