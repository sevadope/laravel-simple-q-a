<div class="comments-container">
	@if($answer->comments_count > 0)
		<button class="btn btn-link">{{ $answer->comments_count }} comments</button>
	@else
		<button class="btn btn-link">Comment this</button>
	@endif

	<ul class="comments-tab list-group list-group-flush">
		@foreach($answer->comments as $comment)

			@include('public.includes.comment')

		@endforeach

		@auth
			<li class="list-group-item">
				<h5 for="body">{{ auth()->user()->profileName }}</h5>
				<form action="{{ route('comments.storeForAnswer', $answer->id) }}" method="POST">
					@csrf
					
					<input type="hidden" name="commentable_id" 
					value="{{ $answer->id }}">
					
					<textarea name="body" id="body" cols="30" rows="10"
					class="form-control"></textarea>

					<button type="submit">Send</button>
				</form>
			</li>
		@endauth
		
	</ul>

</div>	
