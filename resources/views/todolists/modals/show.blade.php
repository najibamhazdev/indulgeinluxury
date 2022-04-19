
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show To Do details</h2>
        </div>
        <div class="pull-right">
            <a class=" close-model" data-dismiss="modal" > <i class="fa fa-close"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong> {{ $todolist->name }}
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Date:</strong> {{ $todolist->date }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>time:</strong> {{ $todolist->time }}
        </div>
    </div>
	<div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Status:</strong> 
            @if($todolist->stat== '0')
                not Done yet
            @else
                Done
            @endif
            
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Details:</strong> {{ $todolist->details }}
        </div>
    </div>

        
</div>
   
