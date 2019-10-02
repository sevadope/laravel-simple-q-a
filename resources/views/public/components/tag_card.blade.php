<div class="card m-2"  style="width: 17vw;">
    <div class="card-body">
        
        <h5 class="card-title">
    	   <a href="{{ route('tags.info', $tag->slug) }}">
    	       {{ $tag->title }}
    	   </a>
        </h5>
    
        @auth
            @component('public.components.subscribe_btn')
                @slot('item', $tag)
                @slot('subscribe_uri', route('tags.subscribe', $tag->slug))
                @slot('unsubscribe_uri', route('tags.unsubscribe', $tag->slug))
            @endcomponent
        @endauth

        <p class="card-text"> 
        	Subscribers: {{ $tag->subscribers_count }} 
            | Questions: {{ $tag->questions_count }}
    	</p>

    </div>
</div>