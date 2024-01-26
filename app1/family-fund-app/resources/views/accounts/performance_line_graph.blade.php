<div>
    <canvas id="perfGraph2"></canvas>
</div>

@push('scripts')
<script type="text/javascript">
var api = {!! json_encode($api) !!};
let datasets = [{
    label: 'Monthly Performance',
    data: Object.values(api.monthly_performance).map(function(e) {return e.value;}),
    backgroundColor: ['blue'],
    borderColor: ['blue']
}];
let labels = Object.keys(api.monthly_performance);

let addSP500 = {!! $addSP500 !!};
if (addSP500) {
    let sp500 = Object.values(api.sp500_monthly_performance).map(function(e) {return e.value;});
    datasets.push({
        label: 'S&P 500',
        data: sp500,
        backgroundColor: ['red'],
        borderColor: ['red'],
    });
}

var myChart = new Chart(
    document.getElementById('perfGraph2'),
    {
      type: 'line',
      data: {
        labels: labels,
        datasets: datasets
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      },
    }
  );
</script>
@endpush
