@extends('api.base')

@section('content_header', $client->name)

@section('content')
    <div class="form-group">
      <label for="client_id">Client ID</label>
      <input type="text" id="client_id" class="form-control"
      placeholder="{{ $client->getKey() }}" disabled>
    </div>
    <div class="form-group">
      <label for="client_secret">Client secret</label>
      <input type="text" id="client_secret" class="form-control"
      placeholder="{{ $client->secret }}" disabled>
    </div>
    <div class="form-group">
      <label for="redirect_uri">Redirect URI</label>
      <input type="text" id="redirect_uri" class="form-control" 
      placeholder="{{ $client->redirect }}" disabled>
    </div>
	<div class="text-muted">Created: {{ $client->created_at }}</div>

    <a href="{{ route('api.clients.edit', $client) }}" class="btn btn-primary">
        Edit app
    </a>	
@endsection