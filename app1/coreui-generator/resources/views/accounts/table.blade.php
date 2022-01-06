<div class="table-responsive-sm">
    <table class="table table-striped" id="accounts-table">
        <thead>
            <tr>
                <th>Code</th>
        <th>Nickname</th>
        <th>Email Cc</th>
        <th>User Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accounts as $accounts)
            <tr>
                <td>{{ $accounts->code }}</td>
            <td>{{ $accounts->nickname }}</td>
            <td>{{ $accounts->email_cc }}</td>
            <td>{{ $accounts->user_id }}</td>
                <td>
                    {!! Form::open(['route' => ['accounts.destroy', $accounts->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accounts.show', [$accounts->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('accounts.edit', [$accounts->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>