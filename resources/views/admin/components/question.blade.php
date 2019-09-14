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
			<h4 class="text-muted">{{ $question->answers_count }} Answers</h4>

		</div>

		<div class="d-flex align-items-start">
			<a class="btn btn-primary"
			href="{{ route('admin.questions.show', $question->id) }}">
				Show
			</a>

			<a class="btn btn-warning"
			href="{{ route('admin.questions.edit', $question->id) }}" >
				Edit
			</a>
			
			<form action="{{ route('admin.questions.destroy', $question->id) }}"
			method="POST">
				<button type="submit; button" class="btn btn-danger">
					Delete
				</button>				
			</form>			
		</div>
		<div class="">

		</div>
	</div>
	
</li>