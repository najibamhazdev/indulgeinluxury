
        <div class="row">
          <div class="col-lg-12 margin-tb">
              <div class="pull-left">
                  <h2>Create New Template</h2></div>
                  <div class="pull-right">
                      <a class=" close-model" data-dismiss="modal" > <i class="fa fa-close"></i></a>
                  </div>
              </div>
          </div>
          @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          
          {!! Form::open(array('route' => 'emailtemplates.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
          <div class="row">
              
            
            <input type="hidden" name="template" value="template1"> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                      <strong>Name:</strong>
                      {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                  </div>
              </div>
              
              
               <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Header :</strong>
                    <textarea name="headertext" id="headertext" cols="30" rows="10"></textarea>
                    
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Footer :</strong>
                    <textarea name="footertext" id="footertext" cols="30" rows="10"></textarea>
                    
                </div>
              </div>
              
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Photo on top:</strong>
                    <input type="file" name="photo" class="form-control" style="opacity: 1; position:unset;">
                   
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
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    
                    format: 'YYYY-MM-DD'
                });
            });
        </script>    
   
