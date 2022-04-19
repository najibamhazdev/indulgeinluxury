@extends('layouts.app', ['activePage' => 'producttemplates', 'titlePage' => __('producttemplates Managements')])
@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">producttemplates</h4>
              <p class="card-producttemplate"> Here you can manage producttemplates</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="producttemplates"  data-id="0" data-post="data-php" data-action="fromwebsite">Select from the Website</a>
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="producttemplates"  data-id="0" data-post="data-php" data-action="create">Add producttemplate</a>

                  
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
                    <tr><th>No</th><th>Photo</th><th>Name</th><th>Type</th><th>Template</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    
                    
                      @foreach ($producttemplates as $key => $producttemplate)
                        <tr>
                        <td>{{ ++$i }}</td>
                        <td>
                          @if($producttemplate->postorigin == "web")
                            <img src='{{ $producttemplate->photo }}' style="width: 150px; height:auto;" >
                          @else
                          <img src='storage/uploads/{{ $producttemplate->photo }}' style="width: 150px; height:auto;" >
                          @endif
                          
                        </td>
                          <td>{{ $producttemplate->name }}</td>  
                          
                        <td>{{$producttemplate->posttype}}</td>
                        <td>{{$producttemplate->emailtemplate->name}}</td>
                          <td>
                            @if($producttemplate->status==0)
                            <a class="btn btn-secondary buttonaction" data-toggle="modal"  data-id="{{ $producttemplate->id  }}" data-post="data-php" data-pageFamily="producttemplates" data-action="send"  >Send</a>
                            @endif

                            @if($producttemplate->status==0)
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $producttemplate->id  }}" data-post="data-php" data-pageFamily="producttemplates" data-action="edit"  >Edit</a>
                            @endif
                            
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="producttemplates"  data-id="{{ $producttemplate->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                </table>
                {!! $producttemplates->render() !!}
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

      
