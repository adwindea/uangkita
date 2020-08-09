@extends('layout.main', ['title'=> 'Gardu Induk'])

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">
                    {{__('Gardu Induk')}}
                    <button class="btn btn-success float-right" id="add-button" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus"></i> ADD</button>
                    <div class="modal fade" id="add-modal" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Add Gardu Induk</h4>
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </h1>
            </div>
        </div>
    </div>
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
                                <th class="text-center">No</th>
                                <th class="text-center">Action</th>
                                <th class="text-center">Kode Asset GI</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Telepon</th>
                                <th class="text-center">Area</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Lokasi</th>
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
</script>
@endsection
