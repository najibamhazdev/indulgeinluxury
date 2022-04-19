
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Template Info</h2>
            
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

{!! Form::model($emailtemplate, ['method' => 'PATCH','route' => ['emailtemplates.update', $emailtemplate->id], 'enctype'=>'multipart/form-data']) !!}

<div class="row">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', $emailtemplate->name, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Banner title:</strong>
                <img src="storage/uploads/{{$emailtemplate->titlephoto}}" style="width: 100px; height:auto;" ><br>
                <input type="file" name="titlephoto" class="form-control" style="opacity: 1; position:unset;">
               
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Header :</strong>
            <textarea name="headertext" id="headertext" cols="30" rows="10">{{$emailtemplate->headertext}}</textarea>
                
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Photo on top:</strong>
                <img src="storage/uploads/{{$emailtemplate->photo}}" style="width: 100px; height:auto;" ><br>
                <input type="file" name="photo" class="form-control" style="opacity: 1; position:unset;">
               
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Text after Photo :</strong>
                <textarea name="textafterphoto" id="textafterphoto" style="width: 100%; height:100px;">{{$emailtemplate->textafterphoto}}</textarea>
                
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Photo on Footer:</strong>
                <img src="storage/uploads/{{$emailtemplate->footerphoto}}" style="width: 100px; height:auto;" ><br>
                <input type="file" name="footerphoto" class="form-control" style="opacity: 1; position:unset;">
               
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Footer :</strong>
                <textarea name="footertext" id="footertext" cols="30" rows="10">{{$emailtemplate->footertext}}</textarea>
                
            </div>
        </div>
          
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Color:</strong>
                {!! Form::text('color', $emailtemplate->color, array('placeholder' => 'Color','class' => 'form-control')) !!}
            </div>
        </div>  
          
          
          
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      </div>
      
      {!! Form::close() !!}
      
      <script type="text/javascript">
       CKEDITOR.replace( 'headertext' );
       CKEDITOR.replace( 'footertext' );
       </script>

