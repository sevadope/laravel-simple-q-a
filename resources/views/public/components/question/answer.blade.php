<li class="cards-list-item">

	<div class="d-flex justify-content-between">
		<div class="">
			<h6>
				<img class="small-icon d-inline" 
				src="{{ asset('storage/'.$answer->user->profile_image) }}" 
				alt="Profile image">

				<a class="d-inline" 
				href="{{ route('users.info', $answer->user->name) }}">
					{{ $answer->user->profileName }}
				</a>

				<div class="d-inline text-muted">
					{{ '@' . $answer->user_id }}
				</div>				
			</h6>

			<div>{{ $answer->body }}</div>
			
			<small class="text-muted ml-2">{{ $answer->created_at }}</small>
		</div>
		
		<div class="d-flex justify-content-between">
			@if(auth()->id() === $answer->user_id)
				<div class="d-flex align-items-start">

					{{ $add_field ?? '' }}

					<a href="{{ route('answers.edit', $answer->id) }}"
					class="btn btn-primary mr-2">
						Edit
					</a>

					<form class="" method="POST"
					action="{{ route('answers.destroy', $answer->id) }}">
						@method('DELETE')
						@csrf
						<button class="btn" type="submit">Delete</button>
					</form>
												
				</div>
			@endif		
		</div>
	</div>

	@auth
		@component('public.components.like_btn')
			@slot('item', $answer)
			@slot('add_like_url', route('answers.addLike', $answer->id))
			@slot('remove_like_url', route('answers.removeLike', $answer->id))
		@endcomponent	
	@endauth

	@component('public.components.comments_tab')
		@slot('item', $answer)
		@slot('send_comment_url', route('comments.storeForAnswer', $answer->id))
	@endcomponent
</li>