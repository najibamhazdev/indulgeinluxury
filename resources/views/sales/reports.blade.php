@extends('layouts.app', ['activePage' => 'salesreports', 'titlePage' => __('Sales Reports')])
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
                {!! Form::open(array('route' => 'sales.reports','method'=>'PATCH')) !!}
                {{-- <form name="filter" method="POST" action="clientrequests/filter" > --}}
                  <div class="row">

                    {{-- <div class="col-xs-2 col-sm-2 col-md-2">
                      <div class="form-group">
                          <strong>Category: </strong>
                          
                          <select class="form-control" name="category_id" >
                            <option value="">Select a Category</option>
                    
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @if ($category->children)
                                    @foreach ($category->children as $child)
                                        <option value="{{ $child->id }}" {{ $child->id == $category_id ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                          
                      </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                      <div class="form-group">
                        <strong>Item:</strong>
                          
                          
                        <select name="item_id" class="form-control" >
                            <option value="">Select an Item</option>
                          @foreach ($items as $item)
                              <option value="{{$item->id}}" @if($item_id==$item->id) selected @endif >{{$item->name}}</option>
                          @endforeach
                        </select>  
                      </div>
                    </div> --}}
    
                    <div class="col-xs-2 col-sm-2 col-md-2">
                      <div class="form-group">
                          <strong>Client Name:</strong>
                        
                          <select name="client_id" class="form-control select2-options" >
                            <option value="">Select a Client</option>
                              @foreach ($clients as $client)
                              <option value="{{$client->id}}" @if($client_id==$client->id) selected @endif >{{$client->name}}</option>
                              @endforeach
                          </select>

                          {{-- <strong>Employee:</strong>
              `
                          <select name="employee_id" class="form-control" >
                            <option value="">Select an Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{$employee->id}}" @if($employee_id == $employee->id) selected @endif >{{$employee->name}}</option>
                            @endforeach
                          </select>  --}}
                          
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
              <h4 class="card-title ">Sales Operations</h4>
              <p class="card-category"> Here you can manage sales</p>
            </div>
            <div class="card-body">
                              <div class="row">
                
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
                    <tr><th>No</th><th>Client</th><th>Date</th><th>Total ($)</th><th >Profit ($)</th></tr>
                  </thead>
                  <tbody>
                    
                    
                    <?php
                      $total_sale=0;
                      $total_profit=0;
                      ?>
                      @foreach ($sales as $key => $sale)
                      
                      <?php
                      // $total_sale += $sale->total;
                      // $total_profit += $sale->total - ($sale->saleitems->item->unit_price + $sale->empl_commision + $sale->expences);
                      ?>
                        <tr>
                        <td>{{ ++$i }}</td>
                        <td><p class="text-mute">{{$sale->clients->name}}</p></td>
                          
                        
                        <td><p class="text-mute">{{$sale->date}}</p>
                        {{-- {{$sale->saleitems}} --}}
                          <?php
                          $itemprofit = 0;
                          $itemprice = 0;
                          ?>
                        @foreach($sale->saleitems as $item)
                          
                          <?php $itemm=\App\Item::find($item->item_id); 
                            $itemprofit += $item->price - $itemm->unit_price - $item->expences - $item->empl_commision;
                            $itemprice += $item->price; 
                          ?>
                          
                        @endforeach
                      <?php 
                      $total_sale += $itemprice;
                      $total_profit += $itemprofit    
                      ?>
                      </td>
                      <td><p class="text-mute">{{$sale->total}} $</p></td>
                    <td>{{$itemprofit}} $</td>
                        </tr>
                      @endforeach
                        <tr>
                          <td></td>
                          <td></td>
                          
                         
                          <td> </td>
                          <td><strong>Total Sale:</strong> <?php echo $total_sale ?> $</td>
                        
                        <td ><strong>Total Profit:</strong> <?php echo $total_profit ?> $</td>
                        </tr>
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

<script>
 $(document).ready(function(){
                    $('.select2-options').select2();
            }); 

</script>
@endpush

      
