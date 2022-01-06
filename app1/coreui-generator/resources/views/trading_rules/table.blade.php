<div class="table-responsive-sm">
    <table class="table table-striped" id="tradingRules-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Max Sale Increase Pcnt</th>
        <th>Min Fund Performance Pcnt</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tradingRules as $tradingRules)
            <tr>
                <td>{{ $tradingRules->name }}</td>
            <td>{{ $tradingRules->max_sale_increase_pcnt }}</td>
            <td>{{ $tradingRules->min_fund_performance_pcnt }}</td>
                <td>
                    {!! Form::open(['route' => ['tradingRules.destroy', $tradingRules->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tradingRules.show', [$tradingRules->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('tradingRules.edit', [$tradingRules->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>