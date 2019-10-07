@user_liked($item->likes)
	<a href="{{ $remove_like_url }}" 
	class="answer-like like-btn btn btn-outline-success active mb-2">
		You like it
		<span @if($item->likes_count == 0) hidden @endif 
		class="likes-count d-inline" data-likes-count="{{ $item->likes_count }}">
		</span>
	</a>
@else
	<a href="{{ $add_like_url }}"
	class="answer-like like-btn btn btn-outline-success mb-2">
		Like
		<span @if($item->likes_count == 0) hidden @endif 
		class="likes-count" data-likes-count="{{ $item->likes_count }}">
		</span>
	</a>
@enduser_liked		