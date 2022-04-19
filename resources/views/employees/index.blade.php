@extends('layouts.app', ['activePage' => 'employees', 'titlePage' => __('Employees Managements')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Employees</h4>
              <p class="card-category"> Here you can manage Employee</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="employees"  data-id="0" data-post="data-php" data-action="create">Add employee</a>

                  
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
                    <tr><th>No</th><th>Name</th><th>Email</th><th>Country/City</th><th>Job</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    

                      @foreach ($employees as $key => $employee)
                        <tr>
                        <td>{{ ++$i }}</td>
                          <td>{{ $employee->name }}</td>
                          <td>{{ $employee->email }}</td>
                          <td>{{ $employee->countries->country_name }}/{{ $employee->city }}</td>
			                    <td>{{ $employee->job }}</td>
                          <td><a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $employee->id }}" data-post="data-php" data-pageFamily="employees" data-action="show">Show</a>
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $employee->id  }}" data-post="data-php" data-pageFamily="employees" data-action="edit"  >Edit</a>
                            {{-- {!! Form::open(['method' => 'DELETE','route' => ['employee.destroy', $employee->id],'style'=>'display:inline']) !!} --}}
                            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="employees"  data-id="{{ $employee->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                </table>
                {!! $employees->render() !!}
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

      
