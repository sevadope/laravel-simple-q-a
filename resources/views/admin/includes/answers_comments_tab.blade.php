
<div class="answers-tab ml-2">
	<ul class="list-group list-group-flush">
		<h3>Answers:</h3>
		@foreach($item->answers as $answer)
			<li class="list-group-item answer">
				{{ $title ?? '' }}
				<div class="d-flex justify-content-between">
					<h6 class="">
						<a class="d-inline" href="{{ route('admin.users.info', $answer->user->name) }}">
							{{ $answer->user->profileName }}
						</a>
						<div class="d-inline text-muted">{{ '@' . $answer->user->name }}</div>
					</h6>

					<form class="" method="POST" action="{{ route('admin.answers.destroy', $answer->id) }}">
						@method('DELETE')
						@csrf
						<button class="btn" type="submit">Delete</button>
					</form>							
				</div>

				<p>{{ $answer->body }}</p>
				<small class="d-inline text-muted">{{ $answer->created_at }}</small>

				<div class="comments-container">
					@if($answer->comments->count() > 0)
						<button class="btn btn-link">{{ $answer->comments->count() }} comments</button>
					@else
						<button class="btn btn-link">Comment this</button>
					@endif
					<div class="comments-tab">
						<ul class="list-group list-group-flush">

							@foreach($answer->comments as $comment)
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
				</div>	

			</li>
		@endforeach
		
	</ul>
</div>
