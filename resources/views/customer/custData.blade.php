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
                    {{-- <div class="card-header">
                        <h3 class="card-title">Bordered Table</h3>
                    </div> --}}
                <div class="card-body">
                    <table class="table" id="customer_table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center">No</th>
                                <th rowspan="2" class="text-center">Action</th>
                                <th rowspan="2" class="text-center">ID PEL</th>
                                <th rowspan="2" class="text-center">Nama</th>
                                <th rowspan="2" class="text-center">Class</th>
                                <th rowspan="2" class="text-center">Daya</th>
                                <th colspan="3" class="text-center">Pasokan Utama</th>
                                <th colspan="3" class="text-center">Pasokan Cadangan</th>
                            </tr>
                            <tr>
                                <th class="text-center">GI</th>
                                <th class="text-center">Trafo</th>
                                <th class="text-center">Penyulang</th>
                                <th class="text-center">GI</th>
                                <th class="text-center">Trafo</th>
                                <th class="text-center">Penyulang</th>
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
    $('#customer_table').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        scrollX: true,
        stateSave: true,
        ajax: '{!! route('getCustData') !!}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'id_pel', name: 'id_pel'},
            {data: 'name', name: 'name'},
            {data: 'class', name: 'class'},
            {data: 'power', name: 'power'},
            {data: 'gi1', name: 'gi1'},
            {data: 'trafo1', name: 'trafo1'},
            {data: 'penyulang1', name: 'penyulang1'},
            {data: 'gi2', name: 'gi2'},
            {data: 'trafo2', name: 'trafo2'},
            {data: 'penyulang2', name: 'penyulang2'}
        ],
        columnDefs: [
            { visible: false, targets: [ 9, 10, 11] },
            // { orderable: false, targets: [ 0, 2, 7 ] }
        ],
        dom:
            "<'row'<'col-lg-12 col-md-12 col-12'B>>" +
            "<'row'<'col-lg-6 col-md-6 col-sm-12 col-12'l><'col-lg-6 col-md-6 col-sm-12 col-12'f>>" +
            "<'row'<'col-lg-12 col-md-12 col-12 table-responsive'tr>>" +
            "<'row'<'col-lg-5 col-md-5 col-12'i><'col-lg-7 col-md-7 col-12'p>>",
        aoColumns: [
            null,
            {sClass: "text-center"},
            {sClass: "text-center"},
            null,
            {sClass: "text-center"},
            {sClass: "text-center"},
            null,
            null,
            null,
            null,
            null,
            null,
            null
        ],
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
            messageTop: 'Company Data'
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
