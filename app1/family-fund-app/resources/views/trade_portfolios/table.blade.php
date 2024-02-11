<div class="table-responsive-sm">
    <table class="table table-striped" id="tradePortfolios-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Account Name</th>
            <th>Portfolio Id</th>
            <th>Portfolio Source</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Cash Target</th>
            <th>Cash Reserve Target</th>
            <th>Max Single Order</th>
            <th>Minimum Order</th>
            <th>Rebalance Period</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tradePortfolios as $tradePortfolio)
            <tr>
                <td>{{ $tradePortfolio->id }}</td>
                <td>{{ $tradePortfolio->account_name }}</td>
                <td>{{ $tradePortfolio->portfolio_id }}</td>
                <td>{{ $tradePortfolio->portfolio_id? $tradePortfolio->portfolio()->source : "N/A" }}</td>
                <td>{{ $tradePortfolio->start_dt }}</td>
                <td>{{ $tradePortfolio->end_dt }}</td>
                <td>{{ $tradePortfolio->cash_target * 100 }}%</td>
                <td>{{ $tradePortfolio->cash_reserve_target * 100 }}%</td>
                <td>{{ $tradePortfolio->max_single_order * 100 }}%</td>
                <td>${{ $tradePortfolio->minimum_order }}</td>
                <td>{{ $tradePortfolio->rebalance_period }} days</td>
                <td>
                    {!! Form::open(['route' => ['tradePortfolios.destroy', $tradePortfolio->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tradePortfolios.show', [$tradePortfolio->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('tradePortfolios.edit', [$tradePortfolio->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
