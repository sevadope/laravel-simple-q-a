<li class="cards-list-item">
	<div class="">
		<img class="small-icon" 
		src="{{ asset('storage/'.$item->profile_image) }}" alt="Profile image">
		<a href="{{ route('users.info', $item->id) }}">
			{{ $item->profile_name }}
		</a>
		<br>
		<small class="text-muted">Answers: {{ $item->answers_count }}</small>
		<small class="text-muted">Questions: {{ $item->questions_count }}</small>
	</div>
</li>