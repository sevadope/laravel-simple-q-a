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
            @foreach($answers as $answer)
                <tr>
                    <th scope="row">{{ $answer->id }}</th>
                    <td>{{ $answer->user->profileName }}</td>
                    <td>{{ $answer->body }}</td>
                    <td>{{ $answer->created_at }}</td>
                    <td class="d-flex align-items-start">
                        <a class="btn btn-primary"
                        href="{{ route('admin.questions.show', $answer->question_id) }}">
                            Show
                        </a>

                        <a class="btn btn-warning"
                        href="{{ route('admin.answers.edit', $answer->id) }}" >
                            Edit
                        </a>
                        
                        <form action="{{ route('admin.answers.destroy', $answer->id) }}" method="POST">
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