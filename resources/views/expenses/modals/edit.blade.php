
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Personel Expenses</h2>
            
        </div>
        <div class="pull-right">
            <a class=" close-model" data-dismiss="modal" > <i class="fa fa-close"></i></a>
        </div>
    </div>
</div>

@if (count($errors) > 0)<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{!! Form::model($expense, ['method' => 'PATCH','route' => ['expenses.update', $expense->id]]) !!}

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong>
            {!! Form::text('name', $expense->name, array('placeholder' => 'Title','class' => 'form-control')) !!}
        </div>
    </div>
    


    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Amount ($):</strong>
            {!! Form::text('amount', $expense->amount, array('placeholder' => 'Expences amount','class' => 'form-control')) !!}
        </div>
    </div>
    
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Date :</strong>
        <input class="date form-control datepicker" name="date" id="datetimepicker1" value="{{$expense->date}}" type="text">
            
        </div>
    </div>
  
    
                
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Details:</strong>
          {!! Form::textarea('details',$expense->details, array('placeholder' => 'Details','class' => 'form-control')) !!}
      </div>
        </div>
    
    
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

