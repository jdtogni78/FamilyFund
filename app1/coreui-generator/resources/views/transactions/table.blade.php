<div class="table-responsive-sm">
    <table class="table table-striped" id="transactions-table">
        <thead>
            <tr>
                <th>Source</th>
        <th>Type</th>
        <th>Shares</th>
        <th>Account Id</th>
        <th>Matching Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transactions)
            <tr>
                <td>{{ $transactions->source }}</td>
            <td>{{ $transactions->type }}</td>
            <td>{{ $transactions->shares }}</td>
            <td>{{ $transactions->account_id }}</td>
            <td>{{ $transactions->matching_id }}</td>
                <td>
                    {!! Form::open(['route' => ['transactions.destroy', $transactions->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('transactions.show', [$transactions->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('transactions.edit', [$transactions->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>