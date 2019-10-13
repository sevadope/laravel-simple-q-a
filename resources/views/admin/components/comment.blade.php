<li class="cards-list-item">

	<h6 class="">
		<img class="small-icon d-inline" src="{{ asset('storage/'.$comment->user->profile_image) }}" 
		alt="Profile image">

		<a class="d-inline" href="{{ route('admin.users.info', $comment->user->name) }}">
			{{ $comment->user->profileName }}
		</a>
		<div class="d-inline text-muted">{{ '@' . $comment->user->id }}</div>
	</h6>

	<div class="d-flex justify-content-between">

		<div class="">
			<div>{{ $comment->body }}</div>
			<small class="text-muted">{{ $comment->created_at }}</small>
			<br>
			<div class="text-success">
				Likes: {{ $comment->likes_count }}
			</div>
		</div>

		<div class="d-flex flex-row-reverse">		
			<form class="" method="POST" 
			action="{{ route('admin.comments.destroy', $comment->id) }}">
				@method('DELETE')
				@csrf
				<button class="btn btn-link" type="submit">Delete</button>
			</form>	

			<a href="{{ route('admin.comments.edit', $comment->id) }}"
			class="btn btn-link">
				Edit
			</a>
		</div>

	</div>
</li>