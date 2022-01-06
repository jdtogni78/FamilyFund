<div class="table-responsive-sm">
    <table class="table table-striped" id="accountMatchingRules-table">
        <thead>
            <tr>
                <th>Account Id</th>
        <th>Matching Id</th>
        <th>Created</th>
        <th>Updated</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accountMatchingRules as $accountMatchingRules)
            <tr>
                <td>{{ $accountMatchingRules->account_id }}</td>
            <td>{{ $accountMatchingRules->matching_id }}</td>
            <td>{{ $accountMatchingRules->created }}</td>
            <td>{{ $accountMatchingRules->updated }}</td>
                <td>
                    {!! Form::open(['route' => ['accountMatchingRules.destroy', $accountMatchingRules->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accountMatchingRules.show', [$accountMatchingRules->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('accountMatchingRules.edit', [$accountMatchingRules->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>