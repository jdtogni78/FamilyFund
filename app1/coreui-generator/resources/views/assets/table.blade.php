<div class="table-responsive-sm">
    <table class="table table-striped" id="assets-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Type</th>
        <th>Source Feed</th>
        <th>Feed Id</th>
        <th>Last Price</th>
        <th>Last Price Date</th>
        <th>Deactivated</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assets as $assets)
            <tr>
                <td>{{ $assets->name }}</td>
            <td>{{ $assets->type }}</td>
            <td>{{ $assets->source_feed }}</td>
            <td>{{ $assets->feed_id }}</td>
            <td>{{ $assets->last_price }}</td>
            <td>{{ $assets->last_price_date }}</td>
            <td>{{ $assets->deactivated }}</td>
                <td>
                    {!! Form::open(['route' => ['assets.destroy', $assets->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('assets.show', [$assets->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('assets.edit', [$assets->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>