@extends('admin.base')



@section('content_header')
    <div class="d-flex justify-content-between">
        <div class="">
            Tags
        </div>
        
        @admin
            <a href="{{ route('admin.tags.create') }}" class="btn btn-success">
                New
            </a>
        @endadmin
    </div>
@endsection


@section('content')

    @include('admin.components.tags_table')
    {{ $tags->links() }}

@endsection