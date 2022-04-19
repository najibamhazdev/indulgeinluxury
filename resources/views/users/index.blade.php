@extends('layouts.app', ['activePage' => 'users', 'titlePage' => __('Users Managements')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Users</h4>
              <p class="card-category"> Here you can manage users</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  @can('role-list')
                  <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary buttonaction" >Users Roles</a>
                  @endcan
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="users"  data-id="0" data-post="data-php" data-action="create">Add user</a>

                  
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
                    <tr><th>No</th><th>Name</th><th>Email</th><th>Roles</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    

                      @foreach ($data as $key => $user)
                        <tr>
                          <td>{{ ++$i }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>@if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                            @endif
                          </td>
                          <td><a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $user->id }}" data-post="data-php" data-pageFamily="users" data-action="show">Show</a>
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $user->id  }}" data-post="data-php" data-pageFamily="users" data-action="edit"  >Edit</a>
                            {{-- {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline']) !!} --}}
                            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="users"  data-id="{{ $user->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                </table>
                {!! $data->render() !!}
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

      