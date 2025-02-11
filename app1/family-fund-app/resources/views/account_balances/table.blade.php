<div class="table-responsive-sm">
    <table class="table table-striped" id="accountBalances-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Type</th>
                <th>Previous Id</th>
                <th>Previous Shares</th>
                <th>Shares</th>
                <th>Account Id</th>
                <th>Account Nickname</th>
                <th>Transaction Id</th>
                <th>Start Dt</th>
                <th>End Dt</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accountBalances as $accountBalance)
            <tr>
                <td>{{ $accountBalance->id }}</td>
                <td>{{ $accountBalance->type }}</td>
                <td>{{ $accountBalance->previousBalance?->id }}</td>
                <td>{{ $accountBalance->previousBalance?->shares }}</td>
                <td>{{ $accountBalance->shares }}</td>
                <td>{{ $accountBalance->account_id }}</td>
                <td>{{ $accountBalance->account->nickname }}</td>
                <td>{{ $accountBalance->transaction_id }}</td>
                <td>{{ $accountBalance->start_dt }}</td>
                <td>{{ $accountBalance->end_dt }}</td>
                <td>
                    {!! Form::open(['route' => ['accountBalances.destroy', $accountBalance->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accountBalances.show', [$accountBalance->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('accountBalances.edit', [$accountBalance->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#accountBalances-table').DataTable();
    });
</script>
@endpush
