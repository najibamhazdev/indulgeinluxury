@extends('layouts.app', ['activePage' => 'items', 'titlePage' => __('Items Managements')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Items</h4>
              <p class="card-category"> Here you can manage items</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="items"  data-id="0" data-post="data-php" data-action="create">Add item</a>

                  
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
                    <tr><th>No</th><th>Name</th><th>Category</th><th>Brand</th><th>Unit Price</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    

                      @foreach ($items as $key => $item)
                        <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->name }}</td>
                          <td> 
                            <p >  @if($item->categories->parent) <span class="text-muted">{{$item->categories->getparent->name}} / </span> @endif {{ $item->categories ? $item->categories->name : 'Uncategorized' }}</p>
                          </td>
                          <td>{{ $item->brands->name }}</td>
                          
			  <td>{{ $item->unit_price }}</td>
                          <td><a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $item->id }}" data-post="data-php" data-pageFamily="items" data-action="show">Show</a>
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $item->id  }}" data-post="data-php" data-pageFamily="items" data-action="edit"  >Edit</a>
                           
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="items"  data-id="{{ $item->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                </table>
                {!! $items->render() !!}
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

      
