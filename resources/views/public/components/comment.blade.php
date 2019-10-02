<li class="list-group-item">
			
	{{ $title ?? '' }}
	
	<h6 class="">
		<a class="d-inline" href="{{ route('users.info', $comment->user->name) }}">
			{{ $comment->user->profileName }}
		</a>
		<div class="d-inline text-muted">{{ '@' . $comment->user->id }}</div>
	</h6>

	<div class="d-flex justify-content-between">

		<div class="">
			<div>{{ $comment->body }}</div>
			<small class="text-muted">{{ $comment->created_at }}</small>
			<br>

			@auth
				@user_liked($comment->likes)
					<a href="{{ route('comments.removeLike', $comment->id) }}"
					class="comment-like like-btn text-success active">
							You like it
						<span @if($comment->likes_count == 0) hidden @endif 
						class="likes-count" data-likes-count="{{ $comment->likes_count }}">
						</span>
					</a>
				@else
					<a href="{{ route('comments.addLike', $comment->id) }}"
					class="comment-like like-btn text-success">
							Like
						<span @if($comment->likes_count == 0) hidden @endif 
						class="likes-count" data-likes-count="{{ $comment->likes_count }}">
						</span>
					</a>
				@enduser_liked
			@endauth
			
		</div>

		@if(auth()->id() === $comment->user_id)
			<div class="d-flex flex-row-reverse">

				<form class="" method="POST" 
				action="{{ route('comments.destroy', $comment->id) }}">
					@method('DELETE')
					@csrf
					<button class="btn btn-link text-danger" type="submit">Delete</button>
				</form>		

				<a href="{{ route('comments.edit', $comment->id) }}"
				class="btn btn-link">
					Edit
				</a>		
			</div>
		@endif

	</div>
</li>