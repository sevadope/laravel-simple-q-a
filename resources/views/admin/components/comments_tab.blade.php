<div class="comments-container d-inline">
	@if($item->comments_count > 0)
		<button class="btn btn-link">{{ $item->comments_count }} comments</button>
	@else
		<button class="btn btn-link">Comment this</button>
	@endif

	<ul class="comments-tab cards-list">
		@foreach($item->comments as $comment)

			@component('admin.components.comment')
				@slot('comment', $comment)
			@endcomponent

		@endforeach

		@auth
			<li class="cards-list-item">
				<h5 for="body">{{ auth()->user()->profileName }}</h5>
				<form action="{{ $send_comment_url }}" method="POST">
					@csrf
					
					<input type="hidden" name="commentable_id" 
					value="{{ $item->id }}">
					
					<textarea name="body" id="body" cols="30" rows="10"
					class="form-control"></textarea>

					<button class="btn btn-primary mt-2" type="submit">Send</button>
				</form>
			</li>
		@endauth
	</ul>

</div>	
