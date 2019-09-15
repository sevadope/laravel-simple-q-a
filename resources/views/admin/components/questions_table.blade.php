    <table class="table">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tags</th>
              <th scope="col">Title</th>
              <th scope="col">Subscribers</th>
              <th scope="col">Answers</th>
              <th scope="col">Asked</th>
              <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                <tr>
                    <th scope="row">{{ $question->id }}</th>
                    <td>{{ $question->tagsTitle }}</td>
                    <td>{{ $question->title }}</td>
                    <td>{{ $question->subscribers_count }}</td>
                    <td>{{ $question->answers_count }}</td>
                    <td>{{ $question->created_at }}</td>
                    <td class="d-flex align-items-start">
                        <a class="btn btn-primary"
                        href="{{ route('admin.questions.show', $question->id) }}">
                            Show
                        </a>

                        <a class="btn btn-warning"
                        href="{{ route('admin.questions.edit', $question->id) }}" >
                            Edit
                        </a>
                        
                        <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST">
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