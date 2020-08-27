@extends('layout.main', ['title'=> 'Input Spend'])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Input Spend</h1>
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
                        <div class="card-body">
                            <div class="form-group">
                                <label for="spend">Spend</label>
                                <input type="text" class="form-control" id="spend" placeholder="Spend">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" placeholder="Select or Type New" style="width:100%;">
                                    <option value=""></option>
                                    @isset($categories)
                                        @foreach($categories as $cat)
                                    <option value="{{ \Crypt::encrypt($cat->id) }}">{{ $cat->category_name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amound</label>
                                <input type="text" class="form-control" id="amount" placeholder="IDR">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('#category').select2({
            placeholder: 'Select or Type New',
            tags: true
        });
    </script>
@endsection
