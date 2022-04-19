@extends('layouts.app', ['activePage' => 'sales', 'titlePage' => __('Sales Managements')])
@section('content')
<div class="content saleslist">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Sales Operations</h4>
              <p class="card-category"> Here you can manage sales</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="sales"  data-id="0" data-post="data-php" data-action="create">Add sale</a>

                  
                </div>
              </div>

              @if ($message = Session::get('success'))
              <div class="alert alert-success">
                <p>{{ $message }}</p>
              </div>
              @endif

              @if ($message = Session::get('failure'))
              <div class="alert alert-danger">
                <p>{{ $message }}</p>
              </div>
              @endif

              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <tr><th>No</th><th>Client</th><th>Total ($)</th><th>Date</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    

                      @foreach ($sales as $key => $sale)
                        <tr>
                        <td>{{ ++$i }}</td>
                          <td>{{ $sale->clients->name }}</td>
                          <td>{{ $sale->total }} $</td>
                          <td>{{ $sale->date }}</td>
                          <td><a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $sale->id }}" data-post="data-php" data-pageFamily="sales" data-action="show">Show</a>
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $sale->id  }}" data-post="data-php" data-pageFamily="sales" data-action="edit"  >Edit</a>
                           
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="sales"  data-id="{{ $sale->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                </table>
                {!! $sales->render() !!}
              </div>
            </div>
          </div>
          
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')


@endpush


      
