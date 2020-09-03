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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-8 col-md-6">
                                    {{-- <h3 class="card-title">Halo {{$user->name}} ngangenin, klik menu lainnya di samping kiri ya.</h3> --}}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" class="form-control float-right text-center datepicker" id="month" name="month" autocomplete="off" value="{{$month}}">
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
    <script type="text/javascript">
        $('#dashboard-content').load('{{route("fiLoadDashboard", $month, false)}}');
        $('.datepicker').datepicker({
            autoclose: true,
            format : "yyyy-mm",
            viewMode : "months",
            minViewMode: "months",
            todayHighlight : true
        });
        $('#month').on('change', function(){
            var month = $('#month').val();
            var url = '{{route("fiLoadDashboard", ":param")}}';
            url = url.replace(':param', month);
            $('#dashboard-content').load(url);
        });
    </script>
@endsection
