
<script type="text/javascript" src="{{URL::asset('/include/charts/Chart.bundle.js')}}"></script>
<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>


<div class="row">
    
    <div class="chart col-lg-8">
        <canvas id="trueorfail"></canvas>
    </div>
    <div class="chart col-lg-4">
        <canvas id="charts"></canvas>
    </div>
    <div class="chart col-lg-12">
        <canvas id="canvas"></canvas>
    </div>

</div>


<script type="text/javascript" src="{{URL::asset('/js/admin/rpa/statistics/utils.js')}}"></script>
	<script>
		var config = () => {
            let labels = '';
            let data1 = '';
            let data2 = '';
            let task = 'taskdistribution';
            let day = 180;
            $.ajax({
                async:false,
                url:"/admin/rpa_log/getData",
                type:'post',
                data:{task:task,day:day},
                dataType:'json',
                success:function(json){
                    for(let i in json){
                        labels = labels+i+',';
                        if(json[i].hasOwnProperty('success')){
                            data1+=json[i]['success'].length+',';
                        }else{
                            data1+='0,';
                        }
                        if(json[i].hasOwnProperty('fail')){
                            data2+=json[i]['fail'].length+',';
                        }else{
                            data2+='0,';
                        }
                    }
                }
            });
            return {    
			type: 'line',
			data: {
				labels: labels.split(','),
				datasets: [{
					label: '成功',
                    show: true, 
					borderColor: window.chartColors.blue,
					backgroundColor: window.chartColors.blue,
					data: data1.split(','),
					fill: false,
				}, {
					label: '失败',
					borderColor: window.chartColors.red,
					backgroundColor: window.chartColors.red,
					data: data2.split(','),
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
                title: {
					display: true,
					text: 'RPA执行统计'
				},
				responsive: true
			}
		};

        var trueorfail_config = {
            type: 'bar',
            data: {
                labels: ['taskdistribution','bak','zwtx','IDidentification','sdxTestWirte','SupervisionSF','SupervisionCFA','CustomerGroupings'],
                datasets: [{
                    label: '执行成功',
                    data: [{{ $tasks['success'] }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: '执行失败',
                    data: [{{ $tasks['fail'] }}],
                    backgroundColor: window.chartColors.grey
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                title: {
					display: true,
					text: 'RPA任务执行统计'
				},
            }
        };

        // Define a plugin to provide data labels
		Chart.plugins.register({
			afterDatasetsDraw: function(chart) {
				var ctx = chart.ctx;

				chart.data.datasets.forEach(function(dataset, i) {
					var meta = chart.getDatasetMeta(i);
					if (!meta.hidden) {
						meta.data.forEach(function(element, index) {
							// Draw the text in black, with the specified font
							ctx.fillStyle = '#ccc';

							var fontSize = 16;
							var fontStyle = 'normal';
							var fontFamily = 'Helvetica Neue';
							ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

							// Just naively convert to string for now
							var dataString = dataset.data[index].toString();

							// Make sure alignment settings are correct
							ctx.textAlign = 'center';
							ctx.textBaseline = 'middle';

							var padding = 5;
							var position = element.tooltipPosition();
							ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
						});
					}
				});
			}
		});

        var trueorfail = document.getElementById("trueorfail");
        window.rpa_trueorfail = new Chart(trueorfail, trueorfail_config);

        window.myRadar = new Chart(document.getElementById('charts'), charts);

        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config());
	</script>
