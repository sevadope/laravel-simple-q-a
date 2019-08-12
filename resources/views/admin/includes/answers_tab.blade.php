
<div class="answers-tab ml-2">
	<ul class="list-group list-group-flush">
		<h3>Answers:</h3>
		@foreach($question->answers as $answer)
			<li class="list-group-item answer">
				<h6 class="d-inline">
					<a href="#">
						{{ $answer->user->profileName }}
					</a>
				</h6>
				<h6 class="d-inline text-muted">{{ '@' . $answer->user->name }}</h6>
				<p>{{ $answer->body }}</p>
				<small class="d-inline text-muted">{{ $answer->created_at }}</small>

				@component('admin.includes.comments_tab')
					@slot('item', $answer)
				@endcomponent
			</li>
		@endforeach
		
	</ul>
</div>
