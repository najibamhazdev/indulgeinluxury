@extends('layouts.app', ['activePage' => 'brands', 'titlePage' => __('Brands Managements')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Brands</h4>
              <p class="card-category"> Here you can manage brands</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="brands"  data-id="0" data-post="data-php" data-action="create">Add category</a>

                  
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
                    <tr><th>No</th><th>Name</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    
                    
                      @foreach ($brands as $key => $category)
                        <tr>
                        <td>{{ ++$i }}</td>
                          <td>{{ $category->name }}</td>
                          
                          
                          <td>
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $category->id  }}" data-post="data-php" data-pageFamily="brands" data-action="edit"  >Edit</a>
                            
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="brands"  data-id="{{ $category->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                </table>
                {!! $brands->render() !!}
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

      
