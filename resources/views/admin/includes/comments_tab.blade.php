<div class="comments-container">
	@if($item->comments_count > 0)
		<button class="btn btn-link">{{ $item->comments_count }} comments</button>
	@else
		<button class="btn btn-link">Comment this</button>
	@endif

	<ul class="comments-tab list-group list-group-flush">
		@foreach($item->comments as $comment)
			@include('admin.includes.comment')
		@endforeach
	</ul>

</div>	

