@extends('layout.main', ['title'=> 'Customer Data'])

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Pelanggan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
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
                        <h3 class="card-title">Bordered Table</h3>
                    </div>
                <div class="card-body">
                    <div class="card-body">
                        <table class="table" id="customer_table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID PEL</th>
                                    <th>Nama</th>
                                    <th>Class</th>
                                    <th>Daya</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{url ('AdminLTE/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{url ('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<link href="{{url ('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<script src="{{url ('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<link href="{{url ('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<script src="{{url ('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url ('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url ('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url ('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url ('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script type="text/javascript">
    $('#customer_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('getCustData') !!}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'id_pel', name: 'id_pel'},
            {data: 'name', name: 'name'},
            {data: 'class', name: 'class'},
            {data: 'power', name: 'power'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
</script>
@endsection
