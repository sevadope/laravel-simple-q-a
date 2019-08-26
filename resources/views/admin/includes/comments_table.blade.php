    <table class="table">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">User</th>
              <th scope="col">Body</th>
              <th scope="col">Date</th>
              <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <th scope="row">{{ $comment->id }}</th>
                    <td>{{ $comment->user->profileName }}</td>
                    <td>{{ $comment->body }}</td>
                    <td>{{ $comment->created_at }}</td>
                    <td class="d-flex align-items-start">
                        <a class="btn btn-primary"
                        href="{{ route('admin.questions.show', $comment->question->id) }}">
                            Show
                        </a>

                        <a class="btn btn-warning"
                        href="{{ route('admin.comments.edit', $comment->id) }}" >
                            Edit
                        </a>
                        
                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST">
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