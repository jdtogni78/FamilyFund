<div class="table-responsive-sm">
    <table class="table table-striped" id="accounts-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Code</th>
                <th>Nickname</th>
                <th>Email Cc</th>
                <th>User Id</th>
                <th>User Name</th>
                <th>Fund Id</th>
                <th>Fund Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr>
                <td>{{ $account->id }}</td>
                <td>{{ $account->code }}</td>
                <td>{{ $account->nickname }}</td>
                <td>{{ $account->email_cc }}</td>
                <td>{{ $account->user->id ?? '-' }}</td>
                <td>{{ $account->user->name ?? '-' }}</td>
                <td>{{ $account->fund->id ?? '-' }}</td>
                <td>{{ $account->fund->name ?? '-' }}</td>
                <td>
                    {!! Form::open(['route' => ['accounts.destroy', $account->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accounts.show', [$account->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('accounts.edit', [$account->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
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
        $('#accounts-table').DataTable();
    });
</script>
@endpush
