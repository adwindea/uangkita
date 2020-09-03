<div class="box-body">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-sign-in-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Income</span>
                    <span class="info-box-number">
                        {{$total_income}}
                        <small>IDR</small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-sign-out-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Spending</span>
                    <span class="info-box-number">
                        {{$total_spend}}
                        <small>IDR</small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-wallet"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Saving</span>
                    <span class="info-box-number">
                        {{$saving}}
                        <small>IDR</small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-credit-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Saving</span>
                    <span class="info-box-number">
                        {{$saving_percent}}
                        <small>%</small>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="summary-chart"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
        Highcharts.chart('schart', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Beton Instan Sales'
		},
		xAxis: {
			type: 'category'
		},
		yAxis: {
			title: {
				text: 'Bag'
			}
		},
		legend: {
			enabled: true
		},
		plotOptions: {
			series: {
				borderWidth: 0,
				// dataLabels: {
				// 	enabled: true,
				// 	format: '{point.y:.2f} kg'
				// }
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> bag<br/>'
		},

		series: [
			{
				name: "Sales",
                color: Highcharts.getOptions().colors[0],
				data: [{!! $chart !!}]
			}
		],
		drilldown: {
			series: [{!! $dd !!}]
		}
	});
</script>
