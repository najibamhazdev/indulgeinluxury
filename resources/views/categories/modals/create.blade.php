
        <div class="row">
          <div class="col-lg-12 margin-tb">
              <div class="pull-left">
                  <h2>Create New Category</h2></div>
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
          
          {!! Form::open(array('route' => 'categories.store','method'=>'POST')) !!}
          <div class="row">
              
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Parent:</strong>
                                         
                    <select name="parent" class="form-control" >
                        <option value="" >Select a Parent </option>
                      @foreach ($parents as $parent)
                          <option value="{{$parent->id}}" >{{$parent->name}}</option>
                      @endforeach
                    </select>  <span>Or leave it blank to create a parent</span>
                    
                   
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                      <strong>Name:</strong>
                      {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                  </div>
              </div>
              
               
              
              
              
              
              
              
              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </div>
          
          {!! Form::close() !!}

          <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    
                    format: 'YYYY-MM-DD'
                });
            });
        </script>    
   