@extends('layouts.app', ['activePage' => 'subscribers', 'titlePage' => __('Subscibers Managements')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Subscibers Managements</h4>
              <p class="card-category"> Here you can manage subscribers</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  @can('newsletter-create')
                    <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal"  data-id="0" data-post="data-php" data-pageFamily="subscribers" data-action="create">Add Subscriber</a>
                  @endcan  
                  
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
                {{-- <table class="table">
                  <thead class=" text-primary">
                    <tr><th>No</th><th>List Name</th><th>Campaign</th><th>Members Counts</th></tr>
                  </thead>
                  <tbody>
                    
                    

                       @foreach ($data['lists'] as $list)
                        <tr>
                        <td>{{ ++$i }} </td>
                        <td>{{$list['name']}}</td>
                        <td>{{$list['campaign_defaults']['from_name']}}<br>{{$list['campaign_defaults']['from_email']}}<br>{{$list['campaign_defaults']['subject']}} </td>
                           
                          </td>
                          <td>{{$list['stats']['member_count']}}</td>
                        </tr>
                      @endforeach 

                    </tbody>
                </table> --}}

                <table class="table">
                  <thead class=" text-primary">
                    <tr><th>No</th><th>Subscriber Name</th><th>Email</th><th>Status</th><th>Action</th></tr>
                  </thead>
                  <tbody>
                    
                    

                       @foreach ($emails as $sub)
                        <tr>
                          <td>{{ ++$i }} </td>
                          <td>{{$sub[1]}} </td>
                          <td>{{$sub[0]}}</td>
                          <td>{{$sub[2]}}</td>
                          <td><a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $sub[0] }}" data-post="data-php" data-pageFamily="subscribers" data-action="show">Show</a>
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $sub[0]  }}" data-post="data-php" data-pageFamily="subscribers" data-action="edit"  >Edit</a>
                           
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="subscribers"  data-id="{{ $sub[0] }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                        @endforeach
                  </tbody>
                </table>
               
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

      
