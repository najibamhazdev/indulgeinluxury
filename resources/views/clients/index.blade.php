@extends('layouts.app', ['activePage' => 'clients', 'titlePage' => __('Clients Managements')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Clients</h4>
              <p class="card-category"> Here you can manage clients</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="clients"  data-id="0" data-post="data-php" data-action="create">Add client</a>

                  
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
                    <tr><th>No</th><th>Name</th><th>Email</th><th>Country/City</th><th>Gender</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    

                      @foreach ($clients as $key => $client)
                        <tr>
                          <td>{{ ++$i }}</td>
                          <td>{{ $client->name }}</td>
                          <td>{{ $client->email }}</td>
                          <td>{{ $client->countries->country_name }}/{{ $client->city }}</td>
			  <td>{{ $client->gender }}</td>
                          <td><a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $client->id }}" data-post="data-php" data-pageFamily="clients" data-action="show">Show</a>
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $client->id  }}" data-post="data-php" data-pageFamily="clients" data-action="edit"  >Edit</a>
                            {{-- {!! Form::open(['method' => 'DELETE','route' => ['client.destroy', $client->id],'style'=>'display:inline']) !!} --}}
                            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="clients"  data-id="{{ $client->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                </table>
                {!! $clients->render() !!}
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

      
