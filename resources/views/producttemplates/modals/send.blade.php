{!! Form::model($campaign, ['method' => 'POST','route' => ['campaigns.send', $campaign->id]]) !!}
<div class="modal-body">
    <em>Are you sure that you want to Start Sending</em>?
    <h5>{{$campaign->name}}</h5>
 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

   <button type="submit" class="btn btn-primary photo-delete" data-slug="">Send</button>
 </div>
 {!! Form::close() !!}
