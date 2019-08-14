@extends('admin.base')



@section('content_header')
<div class="d-flex justify-content-between">
    <div class="">
        Questions
    </div>
    <a href="{{ route('admin.questions.create') }}" class="btn btn-success">
        New
    </a>
</div>
@endsection

@section('content')

    <ul class="list-group list-group-flush">
        @foreach($questions as $question)
            @include('admin.includes.question')
        @endforeach
    </ul>

{{ $questions->links() }}

@endsection