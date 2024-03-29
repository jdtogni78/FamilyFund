<div class="table-responsive-sm">
    <table class="table table-striped" id="portfolios-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Fund Id</th>
                <th>Fund Name</th>
                <th>Source</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($portfolios as $portfolio)
            <tr>
                <td>{{ $portfolio->id }}</td>
                <td>{{ $portfolio->fund_id }}</td>
                <td>{{ $portfolio->fund()->first()->name }}</td>
                <td>{{ $portfolio->source }}</td>
                <td>
                    {!! Form::open(['route' => ['portfolios.destroy', $portfolio->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('portfolios.show', [$portfolio->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('portfolios.edit', [$portfolio->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash no_mobile"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger no_mobile', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
