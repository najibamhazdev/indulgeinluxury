@extends('layouts.app', ['activePage' => 'todolists', 'titlePage' => __('To Do List')])
@section('content')
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Filter To Do List
              <p class="card-category"> Here you can filter the List</p>
            </div>
            <div class="card-body">


              <div class="col-12 text-left">
                {!! Form::open(array('route' => 'todolists.reports','method'=>'PATCH')) !!}
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
                          <strong>Date:</strong>
                      <input class="date form-control datepicker" value="{{$fromdate}}" name="fromdate" id="datetimepicker2" type="text">
                      </div>

                      
                  </div>

                  {{-- <div class="col-xs-2 col-sm-2 col-md-2">
                    <div class="form-group">
                      <strong>To Date:</strong>
                      <input class="date form-control datepicker" value="{{$todate}}" name="todate" id="datetimepicker3" type="text">
                  </div>
                  </div> --}}

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
              <h4 class="card-title ">To Do List</h4>
              <p class="card-category"> Here you can manage your personel To Do</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="todolists"  data-id="0" data-post="data-php" data-action="create">Add personel To Do</a>

                  
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
                    <tr><th>No</th><th>Name</th><th>Status</th><th>Date</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    
                      
                      @foreach ($todolists as $key => $todolist)
                     
                        <tr>
                        <td>{{ ++$i }}</td>
                          <td><p class="text-mute">{{$todolist->name}}</p></td>
                          <td>
                            @if($todolist->stat == 0)
                              <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="todolists"  data-id="{{ $todolist->id  }}" data-post="data-php" data-action="setDone">Set as Done </button>
                            @else
                              <span style="font-weight:700; color:green"> Task Done </span>
                            @endif
                            </td>
                          <td>{{ $todolist->date }}/{{ $todolist->time }}</td>
                          <td><a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $todolist->id }}" data-post="data-php" data-pageFamily="todolists" data-action="show">Show</a>
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $todolist->id  }}" data-post="data-php" data-pageFamily="todolists" data-action="edit"  >Edit</a>
                           
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="todolists"  data-id="{{ $todolist->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach
                      

                    </tbody>
                </table>
                {!! $todolists->render() !!}
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

      
