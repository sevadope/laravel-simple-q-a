<ul class="cards-list">
	@if(!$toplist->isEmpty())
		<h5 class="m-2">{{ $title }}</h5>
		@foreach($toplist as $item)
			@component($component_path)
				@slot('item', $item)
			@endcomponent
		@endforeach
	@endif
</ul>