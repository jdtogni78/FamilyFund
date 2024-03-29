<div>
    <canvas id="tradePortfolioGraph{{ $tradePortfolio->id }}"></canvas>
</div>

@push('scripts')
    <script type="text/javascript">
        var api_g = {!! json_encode($tradePortfolio->items) !!};
        var assets_labels = api_g.map(function(e) {return e.symbol;});
        var assets_shares = api_g.map(function(e) {return e.target_share * 100.0;});

        assets_labels.push('Cash');
        assets_shares.push({{ $tradePortfolio['cash_target'] * 100.0 }});

        var myChart = new Chart(
            document.getElementById('tradePortfolioGraph{{ $tradePortfolio->id }}'),
            {
                type: 'doughnut',
                data: {
                    labels: assets_labels,
                    datasets: [{
                        // label: 'My First Dataset',
                        data: assets_shares,
                        backgroundColor: graphColors,
                        hoverOffset: 3
                    }]
                },
            }  );
    </script>
@endpush
