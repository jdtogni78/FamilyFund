<div class="table-responsive-sm">
    <table class="table table-striped" id="performance-table">
        <thead>
            <tr>
                <th>Account Nickname</th>
                <th>User Name</th>
                <th>Shares</th>
                <th>Value</th>
                <th>Balance Type</th>
            </tr>
        </thead>
        <tbody>
        @foreach($api['balances'] as $bals)
            <tr>
                <td>{{ $bals['nickname'] }}</td>
                <td>{{ $bals['user']['name'] }}</td>
                <td>{{ $bals['shares'] }}</td>
                <td>{{ $bals['value'] }}</td>
                <td>{{ $bals['type'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>