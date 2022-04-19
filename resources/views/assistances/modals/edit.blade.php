
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Sale Assistant Info</h2>
            
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

{!! Form::model($assistance, ['method' => 'PATCH','route' => ['assistances.update', $assistance->id]]) !!}

<div class="row">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', $assistance->name, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
            </div>
        </div>
        
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Company:</strong>
                {!! Form::text('company', $assistance->company, array('placeholder' => 'Company name','class' => 'form-control', 'required')) !!}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Phone:</strong>
                {!! Form::text('phone',$assistance->phone, array('placeholder' => 'Phone Number','class' => 'form-control', 'required')) !!}
            </div>
        </div>
           
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', $assistance->email, array('placeholder' => 'Email','class' => 'form-control', 'required')) !!}
            </div>
        </div>
        
        
        
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Country:</strong>
                
                {{-- {!! Form::text('country','', array('placeholder' => 'Country','class' => 'form-control', 'required')) !!} --}}
                <select name="country" class="form-control select2-options" >
                  @foreach ($countries as $country)
                    @if($country->id==$assistance->country)
                        <option value="{{$country->id}}" selected >{{$country->country_name}}</option>
                    @else
                        <option value="{{$country->id}}"  >{{$country->country_name}} </option>
                    @endif
                  @endforeach
                </select>  
                
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>City:</strong>
                {!! Form::text('city',$assistance->city, array('placeholder' => 'City','class' => 'form-control')) !!}
            </div>
        </div>
        
       
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
<script>
     $(document).ready(function(){
                    $('.select2-options').select2({
                        dropdownParent: $("#myModal")
                    });;
            });
</script>
