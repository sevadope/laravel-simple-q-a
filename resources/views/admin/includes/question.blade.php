<li class="list-group-item">

	<div class="d-flex justify-content-between">
		<div class="">
			<h6 class="text-muted">{{ $question->tagsTitle }}</h6>

			<h3>
				<a href="{{ route('admin.questions.show', $question->id) }}">
					{{ $question->title }}
				</a>
			</h3>
			<h6 class="text-muted">{{ $question->created_at }}</h6>			
		</div>

		<div>
			<h4 class="text-muted">{{ $question->answers->count() }} Answers</h4>
		</div>
	</div>
	
</li>