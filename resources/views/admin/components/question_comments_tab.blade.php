<div class="comments-container d-inline">
	@if($question->comments_count > 0)
		<button class="btn btn-link">
			{{ $question->comments_count }} comments
		</button>
	@else
		<button class="btn btn-link">Comment this</button>
	@endif

	<ul class="comments-tab list-group list-group-flush">
		@foreach($question->comments as $comment)

			@component('public.components.comment')
				@slot('comment', $comment)

				@slot('like_btn')
					Likes: {{ $comment->likes_count }}
				@endslot
			@endcomponent

		@endforeach
	
		<li class="list-group-item">
			<h5>Moderator</h5>
			<form method="POST"
			action="{{ route('admin.comments.storeForQuestion', $question->id) }}">
				@csrf
				
				<input type="hidden" name="commentable_id" 
				value="{{ $question->id }}">
				
				<textarea name="body" id="body" cols="30" rows="10"
				class="form-control"></textarea>

				<button class="btn btn-primary mt-2" type="submit">Send</button>
			</form>
		</li>
	</ul>
</div>
