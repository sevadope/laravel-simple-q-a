<form action="{{ route('admin.comments.storeForAnswer', $id) }}" method="POST">
	@csrf

	<input type="hidden" name="commentable_id" value="{{ $id }}">

	<div class="form-group">
		<textarea class="form-control col-xs-3" maxlength="5000" 
		name="body" id="body" cols="1" rows="5"
		required></textarea>
	</div>		
	<div class="form-group">
		<button type="submit" class="btn btn-success">Send</button>
	</div>
				
</form>