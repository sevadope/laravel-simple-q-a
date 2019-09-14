@extends('admin.base')

@section('content_header')
    <div class="d-flex justify-content-between">
        <div class="">
            Questions
        </div>
        @admin
            <a href="{{ route('admin.questions.create') }}" class="btn btn-success">
                New
            </a>
        @endadmin
    </div>
@endsection

@section('content')

@include('admin.components.questions_table')

{{ $questions->links() }}

@endsection