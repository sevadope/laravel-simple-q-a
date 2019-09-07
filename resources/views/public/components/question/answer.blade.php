<li class="list-group-item">

	<div class="d-flex justify-content-between">
		<h6 class="">
			<a class="d-inline" 
			href="{{ route('users.info', $answer->user->name) }}">
				{{ $answer->user->profileName }}
			</a>
			<div class="d-inline text-muted">{{ '@' . $answer->user_id }}</div>
		</h6>
		
		<div class="d-flex  justify-content-between">

			{{ $add_field ?? '' }}
			
			@if(auth()->id() === $answer->user_id)
				<a href="{{ route('answers.edit', $answer->id) }}" class="btn btn-primary mr-2">Edit</a>

				<form class="" method="POST" action="{{ route('answers.destroy', $answer->id) }}">
					@method('DELETE')
					@csrf
					<button class="btn" type="submit">Delete</button>
				</form>		
			@endif		
			
		</div>
	</div>
	
	<p>{{ $answer->body }}</p>
	
	<small class="text-muted">{{ $answer->created_at }}</small>
	<br>
	{{ $like_btn ?? '' }}

	@component('public.components.answer_comments_tab')
		@slot('answer', $answer)
	@endcomponent
</li>