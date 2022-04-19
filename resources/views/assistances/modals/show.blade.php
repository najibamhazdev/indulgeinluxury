
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Assistant Info</h2>
        </div>
        <div class="pull-right">
            <a class=" close-model" data-dismiss="modal" > <i class="fa fa-close"></i></a>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong> {{ $assistance->name }}</div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Company:</strong> {{ $assistance->company }}
            </div>
        </div>

        
        

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Phone:</strong> {{ $assistance->phone }}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong> {{ $assistance->email }}
            </div>
        </div>

        
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Country:</strong> {{ $assistance->country_name}}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>City:</strong> {{ $assistance->city }}
            </div>
        </div>

        

        
    </div>
   
