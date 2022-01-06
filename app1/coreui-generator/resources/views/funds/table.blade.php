<div class="table-responsive-sm">
    <table class="table table-striped" id="funds-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Goal</th>
        <th>Total Shares</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($funds as $funds)
            <tr>
                <td>{{ $funds->name }}</td>
            <td>{{ $funds->goal }}</td>
            <td>{{ $funds->total_shares }}</td>
                <td>
                    {!! Form::open(['route' => ['funds.destroy', $funds->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('funds.show', [$funds->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('funds.edit', [$funds->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>