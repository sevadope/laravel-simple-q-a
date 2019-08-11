@extends('admin.base')



@section('content_header')
<div class="d-flex justify-content-between">
    <div class="">
        Tags
    </div>
    <a href="{{ route('admin.tags.create') }}" class="btn btn-success">
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
	      <th scope="col">Title</th>
	      <th scope="col">Slug</th>
	      <th scope="col">Createad at</th>
          <th scope="col">Updated at</th>
    	</tr>
  	</thead>
    
	<tbody>
	@foreach($tags as $item)
        <tr>
        	<th scope="row">{{ $item->id }}</th>
        	<td>
                <a href="{{ route('admin.tags.questions', $item->slug) }}">
                    {{ $item->title }}
                </a>
            </td>
        	<td>{{ $item->slug }}</td>
        	<td>{{ $item->created_at }}</td>
            <td>{{ $item->updated_at }}</td>
        </tr>
	@endforeach
    </tbody>
</table>

{{ $tags->links() }}
@endsection