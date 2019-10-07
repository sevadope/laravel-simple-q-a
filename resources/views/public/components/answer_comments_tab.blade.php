<div class="comments-container d-inline">
	@if($answer->comments_count > 0)
		<button class="btn btn-link">{{ $answer->comments_count }} comments</button>
	@else
		<button class="btn btn-link">Comment this</button>
	@endif

	<ul class="comments-tab cards-list">
		@foreach($answer->comments as $comment)

			@component('public.components.comment')
				@slot('comment', $comment)
			@endcomponent

		@endforeach

		@auth
			<li class="cards-list-item">
				<h5 for="body">{{ auth()->user()->profileName }}</h5>
				<form action="{{ route('comments.storeForAnswer', $answer->id) }}" method="POST">
					@csrf
					
					<input type="hidden" name="commentable_id" 
					value="{{ $answer->id }}">
					
					<textarea name="body" id="body" cols="30" rows="10"
					class="form-control"></textarea>

					<button class="btn btn-primary mt-2" type="submit">Send</button>
				</form>
			</li>
		@endauth
		
	</ul>

</div>	
