@extends('layouts.app', ['activePage' => 'expenses', 'titlePage' => __('Personel Expenses')])
@section('content')
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Filter Client Requests </h4>
              <p class="card-category"> Here you can filter the requests</p>
            </div>
            <div class="card-body">


              <div class="col-12 text-left">
                {!! Form::open(array('route' => 'expenses.reports','method'=>'PATCH')) !!}
                {{-- <form name="filter" method="POST" action="clientrequests/filter" > --}}
                  <div class="row">

                    <div class="col-xs-2 col-sm-2 col-md-2">
                      <div class="form-group">
                          <strong>Name: </strong>
                          
                      <input name="filtername" value="{{$filtername}}" class="form-control" placeholder="Name" >
                          
                      </div>
                    </div>

                    

                    <div class="col-xs-2 col-sm-2 col-md-2">
                      <div class="form-group">
                          <strong>From Date:</strong>
                      <input class="date form-control datepicker" value="{{$fromdate}}" name="fromdate" id="datetimepicker2" type="text">
                      </div>

                      
                  </div>

                  <div class="col-xs-2 col-sm-2 col-md-2">
                    <div class="form-group">
                      <strong>To Date:</strong>
                      <input class="date form-control datepicker" value="{{$todate}}" name="todate" id="datetimepicker3" type="text">
                  </div>
                  </div>

                    <div class="col-xs-2 col-sm-2 col-md-2 text-right">
                      <button type="submit" class="btn btn-primary">Filter</button>
                    </div>


                  </div>

                

                {!! Form::close() !!}
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Personel Expenses</h4>
              <p class="card-category"> Here you can manage your personel expenses</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="expenses"  data-id="0" data-post="data-php" data-action="create">Add personel expenses</a>

                  
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
                    <tr><th>No</th><th>Name</th><th>Amount ($)</th><th>Date</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    
                      <?php
                        $total=0;
                        ?>
                      @foreach ($expenses as $key => $expense)
                      <?php
                      $total +=$expense->amount;
                      ?>
                        <tr>
                        <td>{{ ++$i }}</td>
                          <td><p class="text-mute">{{$expense->name}}</p></td>
                          <td>{{ $expense->amount }} $</td>
                          <td>{{ $expense->date }}</td>
                          <td><a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $expense->id }}" data-post="data-php" data-pageFamily="expenses" data-action="show">Show</a>
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $expense->id  }}" data-post="data-php" data-pageFamily="expenses" data-action="edit"  >Edit</a>
                           
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="expenses"  data-id="{{ $expense->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach
                      <tr>
                        <td></td><td></td>
                        <td><strong> Total</strong><br><?php echo $total ?> $</td><td></td><td></td>
                      </tr>

                    </tbody>
                </table>
                {!! $expenses->render() !!}
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

      
