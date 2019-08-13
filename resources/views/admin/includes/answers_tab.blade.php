
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
			</li>
		@endforeach
		
	</ul>
</div>
