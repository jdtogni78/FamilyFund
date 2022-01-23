<div class="table-responsive-sm">
    <table class="table table-striped" id="assets-table">
        <thead>
            <tr>
                <th scope="col">Asest</th>
                <th scope="col">Position</th>
                <th scope="col">Price</th>
                <th scope="col">Market Value</th>
            </tr>
        </thead>
        <tbody>
        @foreach($api['portfolio']['assets'] as $assets)
            <tr>
                <th scope="row">
                    {{ $assets['name'] }}</a>
                </td>
                <td>{{ $assets['position'] }}</td>
                <td>$ {{ $assets['price'] }}</td>
                <td>$ {{ $assets['value'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>