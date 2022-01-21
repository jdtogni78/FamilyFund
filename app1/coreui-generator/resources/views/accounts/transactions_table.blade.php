<div class="table-responsive-sm">
    <table class="table table-striped" id="transactions-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Timestamp</th>
                <th>Type</th>
                <th>Value</th>
                <th>Share Price</th>
                <th>Shares</th>
                <th>Current Value</th>
            </tr>
        </thead>
        <tbody>
        @foreach($api['transactions'] as $trans)
            <tr>
                <td>{{ $trans['id'] }}</td>
                <td>{{ $trans['timestamp'] }}</td>
                <td>{{ $trans['type'] }}</td>
                <td>{{ $trans['value'] }}</td>
                <td>{{ $trans['share_price'] }}</td>
                <td>{{ $trans['shares'] }}</td>
                <td>{{ $trans['current_value'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>