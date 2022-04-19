@extends('layouts.app', ['activePage' => 'emailtemplates', 'titlePage' => __('emailtemplates Managements')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">emailtemplates</h4>
              <p class="card-campaign"> Here you can manage emailtemplates</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="emailtemplates"  data-id="0" data-post="data-php" data-action="create">Add Template</a>

                  
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
                    <tr><th>No</th><th>Banner</th><th>Name</th><th>Created At</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    
                    
                      @foreach ($emailtemplates as $key => $emailtemplate)
                        <tr>
                        <td>{{ ++$i }}</td>
                        <td><img src='storage/uploads/{{ $emailtemplate->photo }}' style="width: 150px; height:auto;" ></td>
                          <td>{{ $emailtemplate->name }}</td>  
                        <td>{{date('d-m-Y', strtotime($emailtemplate->created_at))}}</td>
                          <td>
                            <a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $emailtemplate->id }}" data-post="data-php" data-pageFamily="emailtemplates" data-action="show">Show</a>

                            @if($emailtemplate->status==0)
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $emailtemplate->id  }}" data-post="data-php" data-pageFamily="emailtemplates" data-action="edit"  >Edit</a>
                            @endif
                            
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="emailtemplates"  data-id="{{ $emailtemplate->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                </table>
                {!! $emailtemplates->render() !!}
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

      
