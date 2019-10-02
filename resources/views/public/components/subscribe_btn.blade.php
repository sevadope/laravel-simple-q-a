@user_subscribed($item->subscribers)
	<a href="{{ $unsubscribe_uri }}"
	class="btn btn-outline-primary m-2 subscribe-btn">
		Unsubscribe 
		<span @if($item->subscribers_count == 0) hidden @endif
		data-subscribers-count="{{ $item->subscribers_count }}"
		class="subscribers-count"></span>
	</a>
@else
	<a href="{{ $subscribe_uri }}"
	class="btn btn-outline-primary m-2 subscribe-btn active">
		Subscribe
		<span @if($item->subscribers_count == 0) hidden @endif
		data-subscribers-count="{{ $item->subscribers_count }}"
		class="subscribers-count"></span>
	</a>
@enduser_subscribed