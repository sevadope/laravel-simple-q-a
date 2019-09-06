<div class="card m-2"  style="width: 20vw;">
  <div class="card-body">
    <h5 class="card-title">
    	<a href="{{ route('tags.info', $tag->slug) }}">
    		{{ $tag->title }}
    	</a>
    </h5>
    
    @user_subscribed($tag->subscribers)
      <a href="{{ route('tags.unsubscribe', $tag->slug) }}"
      class="btn btn-outline-primary">
        Unsubscribe
      </a>    
    @else
      <a href="{{ route('tags.subscribe', $tag->slug) }}"
      class="btn btn-primary">
        Subscribe
      </a>
    @enduser_subscribed

    <p class="card-text"> 
    	Subscribers: {{ $tag->subscribers_count }} 
      | Questions: {{ $tag->questions_count }}
	</p>
  </div>
</div>