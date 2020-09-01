@extends('layout.main', ['title'=> 'Spending Data'])

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Spending Data</h1>
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
                    {{-- <div class="card-header">
                        <h3 class="card-title">Bordered Table</h3>
                    </div> --}}
                <div class="card-body">
                    <table class="table" id="spending_table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center" style="min-width:120px;">Category</th>
                                <th class="text-center" style="min-width:250px;">Description</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Timestamp</th>
                            </tr>
                        </thead>
                    </table>
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
<script src="{{url ('AdminLTE/plugins/DataTables/JSZip-2.5.0/jszip.min.js')}}"></script>
<script src="{{url ('AdminLTE/plugins/DataTables/pdfmake-0.1.36/pdfmake.min.js')}}"></script>
<script src="{{url ('AdminLTE/plugins/DataTables/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
<script type="text/javascript">
    $('#spending_table').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        scrollX: true,
        stateSave: true,
        ajax: '{!! route('getSpendData') !!}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'category_name', name: 'category_name'},
            {data: 'description', name: 'description'},
            {data: 'amount', name: 'amount'},
            {data: 'created_at', name: 'created_at'}
        ],
        columnDefs: [
            // { visible: false, targets: [ 9, 10, 11] },
            { className: "text-center", targets: [ 0, 1, 3, 4] },
            { orderable: false, targets: [ 0 ] }
        ],
        dom:
            "<'row'<'col-lg-12 col-md-12 col-12'B>>" +
            "<'row'<'col-lg-6 col-md-6 col-sm-12 col-12'l><'col-lg-6 col-md-6 col-sm-12 col-12'f>>" +
            "<'row'<'col-lg-12 col-md-12 col-12 table-responsive'tr>>" +
            "<'row'<'col-lg-5 col-md-5 col-12'i><'col-lg-7 col-md-7 col-12'p>>",
        // aoColumns: [
        //     null,
        //     {sClass: "text-center"},
        //     {sClass: "text-center"},
        //     null
        // ],
        buttons: [{
            extend:    'copy',
            text:      '<i class="fa fa-copy"></i>',
            titleAttr: 'Copy',
            className: 'btn btn-info'
        },{
            extend:    'excel',
            text:      '<i class="fa fa-file-excel"></i>',
            titleAttr: 'Excel',
            className: 'btn btn-success'
        },{
            extend:    'pdf',
            text:      '<i class="fa fa-file-pdf"></i>',
            titleAttr: 'PDF',
            className: 'btn btn-danger'
        },{
            extend:    'print',
            text:      '<i class="fa fa-print"></i>',
            titleAttr: 'Print',
            className: 'btn btn-warning',
            exportOptions: {
                columns: ':visible'
            },
            messageTop: 'Data Pelanggan'
        },{
            extend: 'colvis',
            className: 'btn btn-default',
            postfixButtons: ['colvisRestore']
        }],
        language: {
            buttons: {
                colvis: 'Columns'
            },
            searchPlaceholder: "Search records",
            search: ""
        }
    });
</script>
@endsection
