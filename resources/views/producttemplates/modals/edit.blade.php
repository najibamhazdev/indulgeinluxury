
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Product Info</h2>
            
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

{!! Form::model($producttemplate, ['method' => 'PATCH','route' => ['producttemplates.update', $producttemplate->id], 'enctype'=>'multipart/form-data']) !!}

<div class="row">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email Template:</strong>
                <select name="emailtemplate_id" id="emailtemplate_id" required class="form-control">
                    @foreach ($emailtemplates as $template)
                <option value="{{$template->id}}" @if($producttemplate->emailtemplate_id == $template->id) selected @endif>{{$template->name}}</option>
                    @endforeach
                   
                </select>
                
            </div>
          </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Name:</strong>
                  {!! Form::text('name', $producttemplate->name, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Post Type:</strong>
                <select name="posttype" id="posttype" required class="form-control">
                    <option value="bigtitle" @if($producttemplate->posttype == "bigtitle") selected @endif >Big Title Center</option>
                    <option value="bigimg" @if($producttemplate->posttype == "bigimg") selected @endif >Big Image</option>
                    <option value="product" @if($producttemplate->posttype == "product") selected @endif >Product</option>
                </select>
                
            </div>
          </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Link:</strong>
                    {!! Form::text('link', $producttemplate->link, array('placeholder' => 'Link','class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Photo:</strong>
                <img src="storage/uploads/{{$producttemplate->photo}}" style="width: 100px; height:auto;" ><br>
                    <input type="file" name="photo" class="form-control" style="opacity: 1; position:unset;">
                   
                </div>
            </div>
            
          </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

