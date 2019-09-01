<li class="list-group-item">
			
	{{ $title ?? '' }}
	
	<div class="d-flex justify-content-between">

		<h6 class="">
			<a class="d-inline" href="{{ route('users.info', $comment->user->name) }}">
				{{ $comment->user->profileName }}
			</a>
			<div class="d-inline text-muted">{{ '@' . $comment->user->id }}</div>
		</h6>

		@if(auth()->id() === $comment->user_id)
			<div class="d-flex justify-content-between">
				<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-link">Edit</a>
				<form class="" method="POST" action="{{ route('comments.destroy', $comment->id) }}">
					@method('DELETE')
					@csrf
					<button class="btn btn-link" type="submit">Delete</button>
				</form>				
			</div>
		@endif

	</div>

	<p>{{ $comment->body }}</p>

	<small class="text-muted">{{ $comment->created_at }}</small>

</li>