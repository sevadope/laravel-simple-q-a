<li class="cards-list-item">

	<div class="d-flex justify-content-between">
		<div class="">
			<div>
				<a href="{{ route('questions.show', $item->id) }}">
					 {{ $item->title }}
				</a>
			</div>
			<small class="text-muted">
				{{ $item->subscribers_count }} subscribers |
				 {{ $item->views_count }} views 
			
			</small>			

		</div>
	</div>
	
</li>