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
                        {{$total_saving}}
                        <small>IDR</small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-check-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Remain</span>
                    <span class="info-box-number">
                        {{$remain}}
                        <small>IDR</small>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Spending</h3>
                </div>
                <div class="card-body">
                    <div id="spending-pie"></div>
                </div>
            </div>
        </div>
        <div id="accordion" class="col-12 col-lg-6 col-md-12">
            <div class="card card-danger">
                <a data-toggle="collapse" data-parent="#accordion" href="#spend-acc" class="collapsed card-header">
                    <h3 class="card-title"><b>Spending</b></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool"><i class="fas fa-minus"></i></button>
                    </div>
                </a>
                <div id="spend-acc" class="panel-collapse in">
                    <div class="card-body table-responsive">
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
            <div class="card card-success">
                <a data-toggle="collapse" data-parent="#accordion" href="#saving-acc" class="collapsed card-header">
                    <h3 class="card-title"><b>Saving</b></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool"><i class="fas fa-minus"></i></button>
                    </div>
                </a>
                <div id="saving-acc" class="panel-collapse in collapse">
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($monthly_saving)
                                    @foreach($monthly_saving as $s)
                                <tr>
                                    <td class="text-center">{{$s->description}}</td>
                                    <td class="text-center">{{number_format($s->amount, 0, ',', '.')}}</td>
                                </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card card-info">
                <a data-toggle="collapse" data-parent="#accordion" href="#income-acc" class="collapsed card-header">
                    <h3 class="card-title"><b>Income</b></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool"><i class="fas fa-minus"></i></button>
                    </div>
                </a>
                <div id="income-acc" class="panel-collapse in collapse">
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($monthly_income)
                                    @foreach($monthly_income as $i)
                                <tr>
                                    <td class="text-center">{{$i->description}}</td>
                                    <td class="text-center">{{number_format($i->amount, 0, ',', '.')}}</td>
                                </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
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
            text: 'Ratio'
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
