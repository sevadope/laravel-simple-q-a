<div class="card m-2"  style="width: 20vw;">
  <div class="card-body">
        <h5 class="card-title">
        	<a href="{{ route('users.info', $user->name) }}">
        		{{ $user->profileName }}
        	</a>
        </h5>
        <p class="card-text"> 
        	{{ $user->briefly_about_myself }}
    	</p>
        <h6 class="card-subtitle mb-2 text-muted d-inline">
            Questions: {{ $user->questions_count }} |
        </h6>
        <h6 class="card-subtitle mb-2 text-muted d-inline">
            Answers: {{ $user->answers_count }}
        </h6>
    </div>
</div>