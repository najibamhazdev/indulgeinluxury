
        <div class="row">
          <div class="col-lg-12 margin-tb">
              <div class="pull-left">
                  <h2>Create New Item</h2></div>
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
          
          {!! Form::open(array('route' => 'items.store','method'=>'POST')) !!}
          <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                      <strong>Name:</strong>
                      {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                  </div>
              </div>
              
               <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                      <strong>Category: </strong>
                      
                      <select class="form-control select2-options" name="category" required>
                        <option value="">Select a Category</option>
                
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                            @if ($category->children)
                                @foreach ($category->children as $child)
                                    <option value="{{ $child->id }}" {{ $child->id === old('category_id') ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                      
                  </div>
              </div>
              
              <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                      <strong>Brand:</strong>
                      {{-- {!! Form::text('brand','', array('placeholder' => 'Brand name','class' => 'form-control')) !!} --}}
  
                      <select class="form-control select2-options" name="brand" required>
                        <option value="">Select a Brand</option>
                
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $brand->id === old('brand') ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                      </select>                   
                    </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Unit Price:</strong>
                    {!! Form::text('unit_price','', array('placeholder' => 'Unit Price in $','class' => 'form-control')) !!}
                </div>
            </div>
               <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                    <strong>Color:</strong>
                    {!! Form::text('color','', array('placeholder' => 'Color','class' => 'form-control')) !!}
                      
                     
                  </div>
              </div> 
              <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                      <strong>Size:</strong>
                      {!! Form::text('size','', array('placeholder' => 'Size','class' => 'form-control')) !!}
                  </div>
              </div>
              
             <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                      <strong>Details:</strong>
                      {!! Form::textarea('details','', array('placeholder' => 'Item Details','class' => 'form-control')) !!}
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

            
            $(document).ready(function(){
                $('.select2-options').select2({
                    dropdownParent: $("#myModal")
                });;
        });
        </script>    
   