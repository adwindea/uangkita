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
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-6">
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
                </div>
                <div class="col-lg-6">
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
                </div>
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
    </script>
@endsection
