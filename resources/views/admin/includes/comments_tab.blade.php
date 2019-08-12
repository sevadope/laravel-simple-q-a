<div class="comments-container">
	@if($item->comments->count() > 0)
		<button class="btn btn-link">{{ $item->comments->count() }} comments</button>
	@else
		<button class="btn btn-link">Comment this</button>
	@endif
		
	<div class="comments-tab ml-4">
		<ul class="list-group list-group-flush">

			@foreach($item->comments as $comment)
				<li class="list-group-item comment">
					<h6 class="d-inline">
						<a href="#">
							{{ $comment->user->profileName }}
						</a>
					</h6>
					<h6 class="d-inline text-muted">{{ '@' . $comment->user->name }}</h6>

					<p>{{ $comment->body }}</p>
					<small class="text-muted">{{ $comment->created_at }}</small>
				</li>
			@endforeach
			

		</ul>
	</div>
</div>
{{--
			<li class="list-group-item comment">
				<li class="list-group-item comment">

					<h6 class="d-inline">
						<a href="#">
							{{ auth()->user()->profileName }}
						</a>
					</h6>
					<h6 class="d-inline text-muted">{{ '@' . auth()->user()->name }}</h6>	
								
				<form method="POST" action="{{ $form_action }}" class="comment-form p-2">
					<input type="hidden" name="{{ $type_id }}" value="{{ $item->id }}">
					<textarea class="form-control mb-2"  name="body" id="" cols="" rows="2"></textarea>
					<button type="submit" class="btn btn-outline-success">Send</button>
				</form>					
			</li>

--}}