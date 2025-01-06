<div class="table-responsive-sm">
    <table class="table table-striped" id="people-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>Primary Phone</th>
                <th>Primary Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($people as $person)
            <tr>
                <td>{{ $person->first_name }}</td>
                <td>{{ $person->last_name }}</td>
                <td>{{ $person->email }}</td>
                <td>{{ $person->birthday }}</td>
                <td>{{ optional($person->primaryPhone())->number_format }}</td>
                <td>{{ optional($person->primaryAddress())->street }}</td>
                <td>
                    {!! Form::open(['route' => ['people.destroy', $person->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('people.show', [$person->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('people.edit', [$person->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
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
        $('#people-table').DataTable();
    });
</script>
@endpush