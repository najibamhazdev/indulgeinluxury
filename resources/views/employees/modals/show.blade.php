
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Employee</h2>
        </div>
        <div class="pull-right">
            <a class=" close-model" data-dismiss="modal" > <i class="fa fa-close"></i></a>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong> {{ $employee[0]->name }}</div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Job:</strong> {{ $employee[0]->job }}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Date Of Birth:</strong> {{ $employee[0]->dob }}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Salary:</strong> {{ $employee[0]->salary }}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Phone:</strong> {{ $employee[0]->phone }}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong> {{ $employee[0]->email }}
            </div>
        </div>

        
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Country:</strong> {{ $employee[0]->country_name}}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>City:</strong> {{ $employee[0]->city }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong> {{ $employee[0]->address }}
            </div>
        </div>

        
    </div>
   
