<div class="comments-container">
	@if($item->comments_count > 0)
		<button class="btn btn-link">{{ $item->comments_count }} comments</button>
	@else
		<button class="btn btn-link">Comment this</button>
	@endif

	<ul class="comments-tab list-group list-group-flush">
		@foreach($item->comments as $comment)
		<li class="list-group-item">
			@include('admin.includes.comment')
		</li>
		@endforeach

		@auth
		<li class="list-group-item">
			{{ $form ?? '' }}
		</li>
		@endauth
	</ul>


</div>	

