<li class="list-group-item">

	<div class="d-flex justify-content-between">
		<div class="">
			<h6 class="text-muted">{{ $question->tagsTitle }}</h6>

			<h3>
				<a href="{{ route('questions.show', $question->id) }}">
					 {{ $question->title }}
				</a>
			</h3>
			<h6 class="text-muted">
				{{ $question->subscribers_count }} subscribers |
				answered {{ $question->created_at }} |
				 {{ $question->views_count }} views
			</h6>			
		</div>

		<div>
			<h4 class="text-muted">{{ $question->answers_count }} Answers</h4>
		</div>
	</div>
	
</li>