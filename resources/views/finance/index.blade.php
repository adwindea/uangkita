@extends('layout.main', ['title'=> 'Dashboard'])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header float-right">
                            <div class="row">
                                <div class="col-md-6 col-12"></div>
                                <div class="col-md-6 col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="from">Start Date</label>
                                                <input type="text" class="form-control float-right text-center datepicker" id="from" name="from" onchange="loadDash()" autocomplete="off" value="{{$from}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="to">End Date</label>
                                                <input type="text" class="form-control float-right text-center datepicker" id="to" name="to" onchange="loadDash()"  autocomplete="off" value="{{$to}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="dashboard-content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ url('/highcharts/code/highcharts.js') }}"></script>
    <script src="{{ url('/highcharts/code/modules/drilldown.js') }}"></script>
    <script type="text/javascript">
        $('#dashboard-content').load('{{route("fiLoadDashboard", [$from, $to], false)}}');
        $('.datepicker').datepicker({
            autoclose: true,
            format : "yyyy-mm-dd",
            // viewMode : "months",
            // minViewMode: "months",
            todayHighlight : true
        });

        function loadDash(){
            var from = $('#from').val();
            var to = $('#to').val();
            var url = '{{route("fiLoadDashboard", [":param1", ":param2"])}}';
            url = url.replace(':param1', from);
            url = url.replace(':param2', to);
            $('#dashboard-content').load(url);
        }
        // $('#month').on('change', function(){
        //     var month = $('#month').val();
        //     var url = '{{route("fiLoadDashboard", ":param")}}';
        //     url = url.replace(':param', month);
        //     $('#dashboard-content').load(url);
        // });
        Highcharts.setOptions({
            colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                return {
                    radialGradient: {
                        cx: 0.5,
                        cy: 0.3,
                        r: 0.7
                    },
                    stops: [
                        [0, color],
                        [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                    ]
                };
            })
        });
    </script>
@endsection
