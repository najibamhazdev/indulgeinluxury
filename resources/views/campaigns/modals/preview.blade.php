{!! Form::model($campaign, ['method' => 'POST','route' => ['campaigns.sendpreview', $campaign->id]]) !!}
<div class="modal-body">
    <em>Sending a preview email</em>?
    <h5>{{$campaign->name}}</h5>
 </div>
 <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Email:</strong>
        {!! Form::email('email', null, array('placeholder' => 'Email','class' => 'form-control', 'required')) !!}
    </div>
</div>

 <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

   <button type="submit" class="btn btn-primary photo-delete" data-slug="">Send</button>
 </div>
 {!! Form::close() !!}
