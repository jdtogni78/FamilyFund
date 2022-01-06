<div class="table-responsive-sm">
    <table class="table table-striped" id="portfolioAssets-table">
        <thead>
            <tr>
                <th>Portfolio Id</th>
        <th>Asset Id</th>
        <th>Shares</th>
        <th>Start Dt</th>
        <th>End Dt</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($portfolioAssets as $portfolioAssets)
            <tr>
                <td>{{ $portfolioAssets->portfolio_id }}</td>
            <td>{{ $portfolioAssets->asset_id }}</td>
            <td>{{ $portfolioAssets->shares }}</td>
            <td>{{ $portfolioAssets->start_dt }}</td>
            <td>{{ $portfolioAssets->end_dt }}</td>
                <td>
                    {!! Form::open(['route' => ['portfolioAssets.destroy', $portfolioAssets->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('portfolioAssets.show', [$portfolioAssets->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('portfolioAssets.edit', [$portfolioAssets->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>