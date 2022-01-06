<div class="table-responsive-sm">
    <table class="table table-striped" id="samples-table">
        <thead>
            <tr>
                <th>Title</th>
        <th>Post Date</th>
        <th>Body</th>
        <th>Email</th>
        <th>Author Gender</th>
        <th>Post Type</th>
        <th>Post Visits</th>
        <th>Category</th>
        <th>Category Short</th>
        <th>Is Private</th>
        <th>Writer Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($samples as $sample)
            <tr>
                <td>{{ $sample->title }}</td>
            <td>{{ $sample->post_date }}</td>
            <td>{{ $sample->body }}</td>
            <td>{{ $sample->email }}</td>
            <td>{{ $sample->author_gender }}</td>
            <td>{{ $sample->post_type }}</td>
            <td>{{ $sample->post_visits }}</td>
            <td>{{ $sample->category }}</td>
            <td>{{ $sample->category_short }}</td>
            <td>{{ $sample->is_private }}</td>
            <td>{{ $sample->writer_id }}</td>
                <td>
                    {!! Form::open(['route' => ['samples.destroy', $sample->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('samples.show', [$sample->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('samples.edit', [$sample->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>