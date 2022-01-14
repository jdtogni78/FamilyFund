<div class="table-responsive-sm">
    <table class="table table-striped" id="accountTradingRules-table">
        <thead>
            <tr>
                <th>Account Id</th>
        <th>Trading Rule Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accountTradingRules as $accountTradingRule)
            <tr>
                <td>{{ $accountTradingRule->account_id }}</td>
            <td>{{ $accountTradingRule->trading_rule_id }}</td>
                <td>
                    {!! Form::open(['route' => ['accountTradingRules.destroy', $accountTradingRule->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accountTradingRules.show', [$accountTradingRule->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('accountTradingRules.edit', [$accountTradingRule->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>