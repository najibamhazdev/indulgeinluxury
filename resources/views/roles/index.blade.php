@extends('layouts.app', ['activePage' => 'roles', 'titlePage' => __('Roles Managements')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Roles Managements</h4>
              <p class="card-category"> Here you can manage users</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  @can('role-create')
                    <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal"  data-id="0" data-post="data-php" data-pageFamily="roles" data-action="create">Add Role</a>
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
                <table class="table">
                  <thead class=" text-primary">
                    <tr><th>No</th><th>Role Name</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    

                      @foreach ($data as $key => $role)
                        <tr>
                          <td>{{ ++$i }}</td>
                          <td>{{ $role->name }}</td>
                          
                          <td><a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $role->id }}" data-post="data-php" data-pageFamily="roles" data-action="show">Show</a>
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $role->id  }}" data-post="data-php" data-pageFamily="roles" data-action="edit"  >Edit</a>
                            {{-- {!! Form::open(['method' => 'DELETE','route' => ['role.destroy', $role->id],'style'=>'display:inline']) !!} --}}
                            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal"  data-id="{{ $role->id  }}" data-pageFamily="roles" data-post="data-php" data-action="delete">Delete </button>
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

      
