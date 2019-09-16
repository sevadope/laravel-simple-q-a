<li class="list-group-item">

	{{ $title ?? '' }}

	<div class="d-flex justify-content-between">
		<h6 class="">
			<a class="d-inline" href="{{ route('admin.users.info', $answer->user->name) }}">
				{{ $answer->user->profileName }}
			</a>
			<div class="d-inline text-muted">{{ '@' . $answer->user->id }}</div>
		</h6>

		<div class="d-flex  justify-content-between">
			
			{{ $add_field }}

			<a href="{{ route('admin.answers.edit', $answer->id) }}" class="btn btn-primary mr-2">Edit</a>

			<form class="" method="POST" action="{{ route('admin.answers.destroy', $answer->id) }}">
				@method('DELETE')
				@csrf
				<button class="btn" type="submit">Delete</button>
			</form>				
		</div>

	</div>
	
	<p>{{ $answer->body }}</p>
	
	<small class="d-inline text-muted">{{ $answer->created_at }}</small>

	{{ $comments ?? '' }}
</li>