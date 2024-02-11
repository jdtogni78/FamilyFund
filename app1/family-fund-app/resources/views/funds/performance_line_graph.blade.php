<div>
    <canvas id="perfGraph2"></canvas>
</div>

@push('scripts')
<script type="text/javascript">
var api = {!! json_encode($api) !!};

let labels = Object.keys(api.monthly_performance);
let data = Object.values(api.monthly_performance).map(function(e) {return e.value;});
let datasets = [{
    label: 'Monthly Performance',
    data: data,
    backgroundColor: ['blue'],
    borderColor: ['blue'],
}];

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

datasets.push({
    label: 'Cash',
    data: Object.values(api.cash).map(function(e) {return e.value;}),
    backgroundColor: ['green'],
    borderColor: ['green'],
});

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
            beginAtZero: false
          }
        }
      },
    }
  );
</script>
@endpush
