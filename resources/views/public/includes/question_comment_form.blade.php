<form action="{{ route('comments.storeForQuestion', $id) }}" method="POST">
	@csrf

	<input type="hidden" name="commentable_id" value="{{ $id }}">

	<div class="form-group">
		<h5 for="body">{{ auth()->user()->profileName }}</h5>
		<textarea class="form-control col-xs-3" maxlength="5000" 
		name="body" id="body" cols="1" rows="5"
		required></textarea>
	</div>		
	<div class="form-group">
		<button type="submit" class="btn btn-success">Send</button>
	</div>
				
</form>