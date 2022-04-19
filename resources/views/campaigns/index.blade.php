@extends('layouts.app', ['activePage' => 'campaigns', 'titlePage' => __('Campaigns Managements')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Campaigns</h4>
              <p class="card-campaign"> Here you can manage campaigns</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  
                  <a  class="btn btn-sm btn-primary buttonaction" data-toggle="modal" data-pageFamily="campaigns"  data-id="0" data-post="data-php" data-action="create">Add Campaign</a>

                  
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
                    <tr><th>No</th><th>Name</th><th>Subject</th><th>Template</th><th width="280px">Action</th></tr>
                  </thead>
                  <tbody>
                    
                    
                    
                      @foreach ($campaigns as $key => $campaign)
                        <tr>
                        <td>{{ ++$i }}</td>
                          <td>{{ $campaign->name }}</td>  
                          <td>
                            {{ $campaign->subject }}
                          </td>
                        <td>{{$campaign->templates->name}}</td>
                          <td>
                            @if($campaign->status==0)
                            <a class="btn btn-info buttonaction" data-toggle="modal"  data-id="{{ $campaign->id  }}" data-post="data-php" data-pageFamily="campaigns" data-action="preview"  >Preview</a>
                            @endif
                            @if($campaign->status==0)
                            <a class="btn btn-success buttonaction" data-toggle="modal"  data-id="{{ $campaign->id  }}" data-post="data-php" data-pageFamily="campaigns" data-action="send"  >Send</a>
                            @endif

                            @if($campaign->status==0)
                            <a class="btn btn-primary buttonaction" data-toggle="modal"  data-id="{{ $campaign->id  }}" data-post="data-php" data-pageFamily="campaigns" data-action="edit"  >Edit</a>
                            @endif
                            
                             <button type="button" class="btn btn-danger buttonaction" data-toggle="modal" data-pageFamily="campaigns"  data-id="{{ $campaign->id  }}" data-post="data-php" data-action="delete">Delete </button>
                            {!! Form::close() !!}
                           
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                </table>
                {!! $campaigns->render() !!}
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

      
