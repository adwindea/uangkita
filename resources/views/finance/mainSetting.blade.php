@extends('layout.main', ['title'=> 'Main Setting'])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Main Setting</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if(Session::has('success'))
            <script>
                toastr["success"]("{{Session::get('success')}}");
            </script>
            @php
                Session::forget('success');
            @endphp
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                </div>
            </div> --}}
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form method="POST" action="{{ route('mainSetting') }}">
                            @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" name="searchText" value={{$searchText}}>
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Parameter</th>
                                    <th class="text-center">Value</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                @php
                                    $a = 1;
                                @endphp
                                @isset($mainsetting)
                                    @foreach($mainsetting as $set)
                                        @php
                                            $xid = Crypt::encrypt($set->id);
                                        @endphp
                                <tr>
                                    <td class="text-center">{{ $a }}</td>
                                    <td>@if($set->tag == 'cut_off'){{__('Cut Off')}}@endif</td>
                                    <td class="text-center">{{ $set->value }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#edit{{$xid}}"><i class="fa fa-pencil-alt"></i></button>
                                        <div class="modal fade" id="edit{{$xid}}" style="padding-right: 15px;" aria-modal="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('editMainSetting') }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Parameter</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="period_date">Cut Off Date</label>
                                                            <input type="text" class="form-control" id="period_date" name="period_date" value="{{ $set->value }}" placeholder="Cut Off Date">
                                                            @if ($errors->has('period_date'))
                                                                <span class="text-danger">{{ $errors->first('period_date') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <input type="hidden" name="setting_id" value="{{$xid}}">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                        @php $a++; @endphp
                                    @endforeach
                                @endisset
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // $('#category').select2({
        //     placeholder: 'Select or Type New',
        //     tags: true,
        //     theme: 'bootstrap4'
        // });
        // $('.datepicker').datepicker({
        //     autoclose: true,
        //     format : "yyyy-mm-dd",
        //     todayHighlight : true
        // });
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
@endsection
