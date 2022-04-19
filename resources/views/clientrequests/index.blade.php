@extends('layouts.app', ['activePage' => 'clientrequests', 'titlePage' => __('Client Requests Managements')])
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


              <div class="col-10 text-left">
                {!! Form::open(array('route' => 'clientrequests.index','method'=>'PATCH')) !!}
                {{-- <form name="filter" method="POST" action="clientrequests/filter" > --}}
                  <div class="row">

                    <div class="col-xs-3 col-sm-3 col-md-3">
                      <div class="form-group">
                          <strong>Category: </strong>
                          
                          <select class="form-control select2-options" name="category_id"  >
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

                    <div class="col-xs-3 col-sm-3 col-md-3">
                      <div class="form-group">
                        <strong>Item:</strong>
                          
                          
                        <select name="item_id" class="form-control select2-options" >
                            <option value="">Select an Item</option>
                          @foreach ($items as $item)
                              <option value="{{$item->id}}" @if($item_id==$item->id) selected @endif >{{$item->name}}</option>
                          @endforeach
                        </select>  
                      </div>
                    </div>
    
                    <div class="col-xs-3 col-sm-3 col-md-3">
                      <div class="form-group">
                          <strong>Client Name:</strong>
                        
                          <select name="client_id" class="form-control select2-options" >
                            <option value="">Select a Client</option>
                              @foreach ($clients as $client)
                              <option value="{{$client->id}}" @if($client_id==$client->id) selected @endif >{{$client->name}}</option>
                              @endforeach
                          </select>
                          
                      </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3 text-right">
                      <button type="submit" class="btn btn-primary">Filter</button>
                    </div>


                  </div>

                </form>

                {{-- {!! Form::close() !!} --}}
              </div>
            </div>
          </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Client Requests </h4>
              <p class="card-category"> Here you can manage requests</p>
            </div>
            <div class="card-body">
             
              <div class="row">
                
                 

                <div class="col-12 text-right">
                  
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="clientrequests"  data-id="0" data-post="data-php" data-action="create">Add Request</a>

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
                    <tr><th>No</th><th>Item Name/Category</th><th>Category requested</th><th>Client</th><th>Date</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    

                      @foreach ($clientrequests as $key => $clientrequest)
                        <tr>
                        <td>{{ ++$i }}</td>
                          <td>
                            
                            
                            @foreach($clientrequest->requestitems as $requestitem)
                              {{$requestitem->items->name}}, 
                            @endforeach
                            
                          </td>
                          <td>
                            @foreach($clientrequest->requestitems as $requestitem)
                              {{$requestitem->categories->name}}, 
                            @endforeach
                            
                          </td>
                          <td>
                            @if($clientrequest->client_id){{ $clientrequest->clients->name }} @endif
                          </td>
                          <td>{{ $clientrequest->date }}</td>
                          <td><a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $clientrequest->id }}" data-post="data-php" data-pageFamily="clientrequests" data-action="show">Show</a>
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $clientrequest->id  }}" data-post="data-php" data-pageFamily="clientrequests" data-action="edit"  >Edit</a>
                           
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="clientrequests"  data-id="{{ $clientrequest->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                </table>
                {!! $clientrequests->render() !!}
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

      
