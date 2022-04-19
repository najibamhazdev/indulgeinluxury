
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Subscriber Info</h2>
        </div>
        <div class="pull-right">
            <a class=" close-model" data-dismiss="modal" > <i class="fa fa-close"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong> {{$subscriber->merge_fields->FNAME}} {{$subscriber->merge_fields->LNAME}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong> {{$subscriber->email_address}} 
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Status:</strong> {{$subscriber->status}} 
               
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Country code:</strong> {{$subscriber->location->country_code}} 
               
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Registration Time:</strong> {{$subscriber->timestamp_opt}} 
               
        </div>
    </div>
</div>

