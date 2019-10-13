<div class="card m-2"  style="width: 17vw;">
  <div class="card-body">
        <img class="big-icon" src="{{ asset('storage/'.$user->profile_image) }}" alt="Profile image">
        <br>
        <h5>
            <a href="{{ route('users.info', $user->name) }}">
                {{ $user->profileName }}
            </a>            
        </h5>
        <div class="card-text"> 
        	{{ $user->briefly_about_myself }}
    	</div>
        <h6 class="card-subtitle mb-2 text-muted d-inline">
            Questions: {{ $user->questions_count }} |
        </h6>
        <h6 class="card-subtitle mb-2 text-muted d-inline">
            Answers: {{ $user->answers_count }}
        </h6>
    </div>
</div>