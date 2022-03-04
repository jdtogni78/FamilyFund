<div class="table-responsive-sm">
    <table class="table table-striped" id="accountReports-table">
        <thead>
            <tr>
                <th>Account Id</th>
        <th>Type</th>
        <th>Start Dt</th>
        <th>End Dt</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accountReports as $accountReport)
            <tr>
                <td>{{ $accountReport->account_id }}</td>
            <td>{{ $accountReport->type }}</td>
            <td>{{ $accountReport->start_dt }}</td>
            <td>{{ $accountReport->end_dt }}</td>
                <td>
                    {!! Form::open(['route' => ['accountReports.destroy', $accountReport->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accountReports.show', [$accountReport->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('accountReports.edit', [$accountReport->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>