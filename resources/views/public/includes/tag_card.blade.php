<div class="card m-2"  style="width: 20vw;">
  <div class="card-body">
    <h5 class="card-title">
    	<a href="{{ route('tags.info', $tag->slug) }}">
    		{{ $tag->title }}
    	</a>
    </h5>
    <p class="card-text"> 
    	Questions: {{ $tag->questions_count }}
	</p>
  </div>
</div>