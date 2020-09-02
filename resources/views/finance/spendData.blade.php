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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <form id="form-filter">
                                    <div id="filterbox" class="collapse">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6 col-12">
                                                <label>From: </label>
                                                <input type="text" class="form-control datepicker" id="from" autocomplete="off">
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-12">
                                                <label>To: </label>
                                                <input type="text" class="form-control datepicker" id="to" autocomplete="off">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-12">
                                                <label>Category: </label>
                                                <select class="form-control select2bs4" multiple="multiple" id="category" style="width: 100%;">
                                                    @isset($categories)
                                                        @foreach($categories as $cat)
                                                    <option value="{{ \Crypt::encrypt($cat->id) }}">{{ $cat->category_name }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <button type="button" id="btn-filter" class="btn btn-primary btn-sm float-right"><i class="fa fa-filter"></i> Filter</button>
                                                <button type="button" id="btn-reset" class="btn btn-default btn-sm"><i class="fa fa-close"></i> Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <a data-toggle="collapse" class="btn btn-primary pull-right btn-xs btn-flat collapsed" href="#filterbox" aria-expanded="false"><i class="fa fa-filter"></i> Filter box</a>
                            </div>
                        </div>
                    </div>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('#spending_table').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        scrollX: true,
        stateSave: true,
        ajax: {
            url: '{!! route('getSpendData') !!}',
            type: "POST",
            data: function (data) {
                data.cat = $('#category').val(),
                data.from = $('#from').val(),
                data.to = $('#to').val()
            }
        },
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
    $('#btn-filter').click(function(){
            table.ajax.reload();
        });
        $('#btn-reset').click(function(){
            $('#form-filter')[0].reset();
            table.ajax.reload();
        });

    $('#category').select2({
        theme: 'bootstrap4'
    });
    jQuery('.datepicker').datepicker({
		autoclose: true,
		format : "yyyy-mm-dd",
		todayHighlight : true
	});
	$('#from').on('changeDate', function (selected) {
		$('#to').datepicker('setStartDate', selected.date);
		$(this).datepicker('hide');
	});
</script>
@endsection
