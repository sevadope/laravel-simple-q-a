<li class="cards-list-item">
	<h4>
    <a href="{{ route('api.clients.show', $client->getKey()) }}">
      {{ $client->name }}
    </a>
  </h4>
	<div class="">Created: {{ $client->created_at }}</div>
</li>