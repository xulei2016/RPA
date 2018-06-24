
<script type="text/javascript" src="{{URL::asset('/include/charts/Chart.bundle.js')}}"></script>
<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>

<div class="row">
    <div class="col-lg-6">
        <canvas id="canvas"></canvas>
    </div>
    <div class="col-lg-6">
        <canvas id="charts"></canvas>
    </div>
</div>
<script type="text/javascript" src="{{URL::asset('/js/admin/rpa/statistics/utils.js')}}"></script>
	<script>
		var config = {
			type: 'line',
			data: {
				labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
				datasets: [{
					label: '立即任务',
					borderColor: window.chartColors.red,
					backgroundColor: window.chartColors.red,
					data: [
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor()
					],
					fill: false,
				}, {
					label: '循环任务',
					borderColor: window.chartColors.blue,
					backgroundColor: window.chartColors.blue,
					data: [
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor()
					],
					fill: false,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'RPA数据统计图表'
				},
				tooltips: {
					mode: 'index',
					callbacks: {
						// Use the footer callback to display the sum of the items showing in the tooltip
						footer: function(tooltipItems, data) {
							var sum = 0;

							tooltipItems.forEach(function(tooltipItem) {
								sum += data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
							});
							return 'Sum: ' + sum;
						},
					},
					footerFontStyle: 'normal'
				},
				hover: {
					mode: 'index',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							show: true,
							labelString: '日期'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							show: true,
							labelString: '次数'
						}
					}]
				}
			}
		};

        var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};

		var color = Chart.helpers.color;
		var charts = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						{{ $info['success']['data'] }},
						{{ $info['fail']['data'] }},
						{{ $info['unknown'] }}
					],
					backgroundColor: [
						window.chartColors.blue,
						window.chartColors.red,
						window.chartColors.yellow,
					],
					label: 'Dataset 1'
				}],
				labels: [
					'成功',
					'失败',
					'未知',
				]
			},
			options: {
				responsive: true
			}
		};

        window.myRadar = new Chart(document.getElementById('charts'), charts);

        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
	</script>
