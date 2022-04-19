
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Category Info</h2>
            
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

{!! Form::model($category, ['method' => 'PATCH','route' => ['categories.update', $category->id]]) !!}

<div class="row">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Parent:</strong>
                                     
                <select name="parent" class="form-control" >
                    <option value="" >Select a Parent </option>
                  @foreach ($parents as $parent)
                    @if($parent->id==$category->parent)
                    <option value="{{$parent->id}}" selected >{{$parent->name}}</option>
                    @else
                    <option value="{{$parent->id}}" >{{$parent->name}}</option>
                    @endif
                      
                  @endforeach
                </select>  <span>Or leave it blank to create a parent</span>
                
               
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Name:</strong>
                  {!! Form::text('name', $category->name, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
              </div>
          </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

