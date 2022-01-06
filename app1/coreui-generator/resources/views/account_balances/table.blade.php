<div class="table-responsive-sm">
    <table class="table table-striped" id="accountBalances-table">
        <thead>
            <tr>
                <th>Type</th>
        <th>Shares</th>
        <th>Account Id</th>
        <th>Tran Id</th>
        <th>Start Dt</th>
        <th>End Dt</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accountBalances as $accountBalances)
            <tr>
                <td>{{ $accountBalances->type }}</td>
            <td>{{ $accountBalances->shares }}</td>
            <td>{{ $accountBalances->account_id }}</td>
            <td>{{ $accountBalances->tran_id }}</td>
            <td>{{ $accountBalances->start_dt }}</td>
            <td>{{ $accountBalances->end_dt }}</td>
                <td>
                    {!! Form::open(['route' => ['accountBalances.destroy', $accountBalances->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accountBalances.show', [$accountBalances->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('accountBalances.edit', [$accountBalances->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>