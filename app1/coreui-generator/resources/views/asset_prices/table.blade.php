<div class="table-responsive-sm">
    <table class="table table-striped" id="assetPrices-table">
        <thead>
            <tr>
                <th>Asset Id</th>
        <th>Price</th>
        <th>Start Dt</th>
        <th>End Dt</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assetPrices as $assetPrices)
            <tr>
                <td>{{ $assetPrices->asset_id }}</td>
            <td>{{ $assetPrices->price }}</td>
            <td>{{ $assetPrices->start_dt }}</td>
            <td>{{ $assetPrices->end_dt }}</td>
                <td>
                    {!! Form::open(['route' => ['assetPrices.destroy', $assetPrices->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('assetPrices.show', [$assetPrices->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('assetPrices.edit', [$assetPrices->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>