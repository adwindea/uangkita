@extends('layout.main', ['title'=> 'Budget Setting'])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">Budget Setting <button class="btn btn-success float-right" data-toggle="modal" data-target="#add-budget"><i class="fa fa-plus"></i> ADD</button></h1>
                    <div class="modal fade" id="add-budget" style="padding-right: 15px;" aria-modal="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('budgetInsert') }}">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Budget</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="form-group row">
                                        <label for="categoryadd" class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <select class="form-control sel2" id="categoryadd" name="category" placeholder="Select or Type New" style="width:100%;">
                                                <option value=""></option>
                                                @isset($categories)
                                                    @foreach($categories as $cat)
                                                <option value="{{ \Crypt::encrypt($cat->id) }}">{{ $cat->category_name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        @if ($errors->has('category'))
                                            <span class="text-danger">{{ $errors->first('category') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label for="period_dateadd" class="col-sm-3 col-form-label">Period</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control text-center datepicker" id="period_dateadd" name="period_date" placeholder="Period">
                                        </div>
                                        @if ($errors->has('period_date'))
                                            <span class="text-danger">{{ $errors->first('period_date') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label for="amountadd" class="col-sm-3 col-form-label">Amount</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control text-center" id="amountadd" name="amount" placeholder="Amount">
                                        </div>
                                        @if ($errors->has('amount'))
                                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Category</th>
                                    <th class="text-center">Period Date</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                @isset($budgets)
                                    @foreach($budgets as $key => $budget)
                                        @php
                                            $xid = Crypt::encrypt($budget->id);
                                        @endphp
                                <tr>
                                    <td class="text-center">{{ $key + $budgets->firstItem() }}</td>
                                    <td>{{ $budget->category()->first()->category_name }}</td>
                                    <td class="text-center">{{ date('M Y', strtotime($budget->period_date)) }}</td>
                                    <td class="text-center">{{ number_format($budget->amount, 0, '', '') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#edit{{$xid}}"><i class="fa fa-pencil-alt"></i></button>
                                        <div class="modal fade" id="edit{{$xid}}" style="padding-right: 15px;" aria-modal="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('budgetInsert') }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Budget</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="form-group row">
                                                            <label for="category" class="col-sm-3 col-form-label">Category</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control text-center" placeholder="Select or Type New" style="width:100%;" disabled>
                                                                    <option value=""></option>
                                                                    @isset($categories)
                                                                        @foreach($categories as $cat)
                                                                    <option value="{{ \Crypt::encrypt($cat->id) }}" @if($cat->id == $budget->category) {{__('selected')}} @endif>{{ $cat->category_name }}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </select>
                                                                <input type="hidden" name="category" value="{{ \Crypt::encrypt($budget->category) }}">
                                                            </div>
                                                            @if ($errors->has('category'))
                                                                <span class="text-danger">{{ $errors->first('category') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="period_date" class="col-sm-3 col-form-label">Period</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control text-center datepicker" id="period_date" name="period_date" value="{{ date('Y-m', strtotime($budget->period_date)) }}" placeholder="Period" readonly>
                                                            </div>
                                                            @if ($errors->has('period_date'))
                                                                <span class="text-danger">{{ $errors->first('period_date') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control text-center" id="amount" name="amount" value="{{ $budget->amount+0 }}" placeholder="Amount">
                                                            </div>
                                                            @if ($errors->has('amount'))
                                                                <span class="text-danger">{{ $errors->first('amount') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <input type="hidden" name="xid" value="{{$xid}}">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                    @endforeach
                                @endisset
                            </table>
                        </div>
                        <div class="card-footer">
                            {{$budgets->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('.sel2').select2({
            placeholder: 'Select Category',
            theme: 'bootstrap4'
        });
        $('.datepicker').datepicker({
            autoclose: true,
            format : "yyyy-mm",
            viewMode : "months",
            minViewMode: "months",
            todayHighlight : true
        });
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
