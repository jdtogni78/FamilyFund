<div class="table-responsive-sm">
    <table class="table table-striped" id="portfolios-table">
        <thead>
            <tr>
                <th>Fund Id</th>
        <th>Last Total</th>
        <th>Last Total Date</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($portfolios as $portfolios)
            <tr>
                <td>{{ $portfolios->fund_id }}</td>
            <td>{{ $portfolios->last_total }}</td>
            <td>{{ $portfolios->last_total_date }}</td>
                <td>
                    {!! Form::open(['route' => ['portfolios.destroy', $portfolios->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('portfolios.show', [$portfolios->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('portfolios.edit', [$portfolios->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>