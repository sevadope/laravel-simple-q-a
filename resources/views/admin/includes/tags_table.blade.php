    <table class="table">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Slug</th>
              <th scope="col">Created</th>
              <th scope="col">Questions</th>
              <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <th scope="row">{{ $tag->id }}</th>
                    <td>{{ $tag->title }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td>{{ $tag->created_at }}</td>
                    <td>{{ $tag->questions_count }}</td>
                    <td class="d-flex align-items-start">
                        <a class="btn btn-primary"
                        href="{{ route('admin.tags.questions', $tag->slug) }}">
                            Show
                        </a>

                        <a class="btn btn-warning"
                        href="{{ route('admin.tags.edit', $tag->slug) }}" >
                            Edit
                        </a>
                        
                        <form action="{{ route('admin.tags.destroy', $tag->slug) }}" method="POST">
                            @method('DELETE')
                            @csrf

                            <button type="submit; button" class="btn btn-danger">
                                Delete
                            </button>               
                        </form>                       
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>