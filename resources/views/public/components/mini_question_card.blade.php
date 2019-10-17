<li class="cards-list-item">

	<div class="d-flex justify-content-between">
		<div class="">
			<div>
				<a href="{{ route('questions.show', $question->id) }}">
					 {{ $question->title }}
				</a>
			</div>
			<small class="text-muted">
				{{ $question->subscribers_count }} subscribers |
				 {{ $question->views_count }} views 
			
			</small>			

		</div>
	</div>
	
</li>