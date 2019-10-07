<table class="table">
  	<thead>
    	<tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      <th scope="col">Email</th>
	      <th scope="col">Signed up at</th>
          <th scope="col">Actions</th>
    	</tr>
  	</thead>
	<tbody>
	@foreach($users as $item)
        <tr>
        	<th scope="row">{{ $item->id }}</th>
        	<td>
                {{ $item->profileName }}
            </td>
        	<td>{{ $item->email }}</td>
        	<td>{{ $item->created_at }}</td>
            <td class="d-flex align-items-start">

                <a class="btn btn-primary"
                href="{{ route('admin.users.info', $item->name) }}">
                    Show
                </a>

                <a class="btn btn-secondary"
                href="{{ route('admin.users.edit', $item->name) }}" >
                    Edit
                </a>
                                            
            </td>
        </tr>
	@endforeach
    </tbody>
</table>