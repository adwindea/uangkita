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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $('#customer_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! json_encode(url("getCustData")) !!}',
        columns: [
            {data: 'id', name: 'No'},
            {data: 'id_pel', name: 'ID PEL'},
            {data: 'name', name: 'Nama'},
            {data: 'class', name: 'Class'},
            {data: 'power', name: 'Daya'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
</script>
@endsection