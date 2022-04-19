
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Personel Expenses details</h2>
        </div>
        <div class="pull-right">
            <a class=" close-model" data-dismiss="modal" > <i class="fa fa-close"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong> {{ $expense->name }}
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Date:</strong> {{ $expense->date }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Amount:</strong> {{ $expense->amount }} $
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Details:</strong> {{ $expense->details }}
        </div>
    </div>

        
</div>
   
