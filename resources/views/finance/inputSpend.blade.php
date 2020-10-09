@extends('layout.main', ['title'=> 'Input Data'])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Input Data</h1>
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
                <div class="col-lg-6">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="spend-tab" data-toggle="pill" href="#spend" role="tab" aria-controls="spend">Spending</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="income-tab" data-toggle="pill" href="#income" role="tab" aria-controls="income">Income</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="saving-tab" data-toggle="pill" href="#saving" role="tab" aria-controls="saving">Saving</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade" id="spend" role="tabpanel" aria-labelledby="spend">
                                    <form method="POST" action="{{ route('inputSpendExe') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="spend_date">Date</label>
                                        <input type="text" class="form-control datepicker" id="spend_date" name="spend_date" value="{{ date('Y-m-d') }}" placeholder="Date">
                                            @if ($errors->has('spend_date'))
                                                <span class="text-danger">{{ $errors->first('spend_date') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                                            @if ($errors->has('description'))
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select class="form-control" id="category" name="category" placeholder="Select or Type New" style="width:100%;">
                                                <option value=""></option>
                                                @isset($categories)
                                                    @foreach($categories as $cat)
                                                <option value="{{ \Crypt::encrypt($cat->id) }}">{{ $cat->category_name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @if ($errors->has('category'))
                                                <span class="text-danger">{{ $errors->first('category') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="IDR">
                                            @if ($errors->has('amount'))
                                                <span class="text-danger">{{ $errors->first('amount') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="income" role="tabpanel" aria-labelledby="income">
                                    <form method="POST" action="{{ route('fiInputIncomeExe') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="income_date">Date</label>
                                        <input type="text" class="form-control datepicker" id="income_date" name="income_date" value="{{ date('Y-m-d') }}" placeholder="Date">
                                            @if ($errors->has('income_date'))
                                                <span class="text-danger">{{ $errors->first('income_date') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="income_description">Description</label>
                                            <input type="text" class="form-control" id="income_description" name="description" placeholder="Description">
                                            @if ($errors->has('description'))
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="income_amount">Amount</label>
                                            <input type="text" class="form-control" id="income_amount" name="amount" placeholder="IDR">
                                            @if ($errors->has('amount'))
                                                <span class="text-danger">{{ $errors->first('amount') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="saving" role="tabpanel" aria-labelledby="income">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <form method="POST" action="{{ route('inputSpendExe') }}">
                    @csrf
                    <div class="card card-danger">
                        <div class="card-header">
                            <h4>Spending</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="spend_date">Date</label>
                            <input type="text" class="form-control datepicker" id="spend_date" name="spend_date" value="{{ date('Y-m-d') }}" placeholder="Date">
                                @if ($errors->has('spend_date'))
                                    <span class="text-danger">{{ $errors->first('spend_date') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category" placeholder="Select or Type New" style="width:100%;">
                                    <option value=""></option>
                                    @isset($categories)
                                        @foreach($categories as $cat)
                                    <option value="{{ \Crypt::encrypt($cat->id) }}">{{ $cat->category_name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                                @if ($errors->has('category'))
                                    <span class="text-danger">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="IDR">
                                @if ($errors->has('amount'))
                                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </div>
                    </form>
                </div> --}}
                {{-- <div class="col-lg-6">
                    <form method="POST" action="{{ route('fiInputIncomeExe') }}">
                    @csrf
                    <div class="card card-success">
                        <div class="card-header">
                            <h4>Income</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="income_date">Date</label>
                            <input type="text" class="form-control datepicker" id="income_date" name="income_date" value="{{ date('Y-m-d') }}" placeholder="Date">
                                @if ($errors->has('income_date'))
                                    <span class="text-danger">{{ $errors->first('income_date') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="income_description">Description</label>
                                <input type="text" class="form-control" id="income_description" name="description" placeholder="Description">
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="income_amount">Amount</label>
                                <input type="text" class="form-control" id="income_amount" name="amount" placeholder="IDR">
                                @if ($errors->has('amount'))
                                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </div>
                    </form>
                </div> --}}
            </div>
        </div>
    </section>
    <script>
        $('#category').select2({
            placeholder: 'Select or Type New',
            tags: true,
            theme: 'bootstrap4'
        });
        $('.datepicker').datepicker({
            autoclose: true,
            format : "yyyy-mm-dd",
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
            "timeOut": "10000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
@endsection
