
	<div class="comments-tab">
		<ul class="list-group list-group-flush">

			@foreach($item->comments as $comment)
				<li class="list-group-item">
					{{ $title ?? '' }}
					<div class="d-flex justify-content-between">
						<h6 class="">
							<a class="d-inline" href="{{ route('admin.users.info', $comment->user->name) }}">
								{{ $comment->user->profileName }}
							</a>
							<div class="d-inline text-muted">{{ '@' . $comment->id }}</div>
						</h6>
						<form class="" method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}">
							@method('DELETE')
							@csrf
							<button class="btn btn-link" type="submit">Delete</button>
						</form>							
					</div>

					<p>{{ $comment->body }}</p>
					<small class="text-muted">{{ $comment->created_at }}</small>
				</li>
			@endforeach
			
		</ul>
	</div>

