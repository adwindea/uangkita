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
        <div class="col-12 col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="spending-pie"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Budget</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Category</th>
                                <th class="text-center">Budget</th>
                                <th class="text-center">Spend</th>
                                <th class="text-center">Remain</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($monthly_spend)
                                @foreach($monthly_spend as $m)
                                    @php
                                        $spend = 0;
                                        $budget = 0;
                                    @endphp
                                    @foreach($m->spending as $s)
                                        @php
                                            $spend = $s->spend_sum+0;
                                        @endphp
                                    @endforeach
                                    @foreach($m->budget as $b)
                                        @php
                                            $budget = $b->budget_sum+0;
                                        @endphp
                                    @endforeach
                                    @php
                                        $remain = $budget - $spend;
                                    @endphp
                            <tr>
                                <td class="text-center">{{$m->category_name}}</td>
                                <td class="text-center">{{number_format($budget, 0, ',', '.')}}</td>
                                <td class="text-center">{{number_format($spend, 0, ',', '.')}}</td>
                                <td class="text-center">{{number_format($remain, 0, ',', '.')}}</td>
                            </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="summary-chart"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    Highcharts.chart('summary-chart', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Spending'
		},
		xAxis: {
			type: 'category'
		},
		yAxis: {
			title: {
				text: 'IDR'
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
			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> IDR<br/>'
		},

		series: [
			{
				name: "Spending",
                color: Highcharts.getOptions().colors[0],
				data: [{!! $chart !!}]
			}
		],
		drilldown: {
			series: [{!! $dd !!}]
		}
	});

    Highcharts.chart('spending-pie', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Monthly Spending'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Share',
            data: [{!!$pie!!}]
        }]
    });
</script>
