
        <div class="row">
          <div class="col-lg-12 margin-tb">
              <div class="pull-left">
                  <h2>Create New Product from the Website</h2></div>
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
          
          {!! Form::open(array('route' => ['producttemplates.storefromweb',0],'method'=>'POST','enctype'=>'multipart/form-data')) !!}
        
           
            
            <div class="row">
              
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email Template:</strong>
                        <select name="emailtemplate_id[]" id="emailtemplate_id" required class="form-control">
                            @foreach ($emailtemplates as $template)
                        <option value="{{$template->id}}">{{$template->name}}</option>
                            @endforeach
                            
                        </select>
                        
                    </div>
                  </div>
                  <input type="hidden" name="productcount" value="{{$products->count()}}" >
            @foreach ($products as $product)
            <input type="hidden" name="link[]" value="https://indulgeinluxurywithsahar.com/web/product/{{$product->post_name}}" >
            <input type="hidden" name="photo[]" value="{{$product->getImageAttribute()}}" >
            <input type="hidden" name="name[]" value="{{$product->post_title}}" >
            <input type="hidden" name="postorigin[]" value="web" >

            {{-- <input type="hidden" name="emailtemplate_id" value="1">  --}}
            <div class="col-xs-2 col-sm-2 col-md-2">
                <div class="form-group">
                    <strong>Insert in tempate</strong>
                    <select name="product[]" >
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>
                    {{-- <input type="checkbox" name="product[]" value="yes"  >  --}}
                    
                </div>
              </div>

              <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <img src="{{$product->getImageAttribute()}}" style="width: 150px; height:auto;" >
                    
                    
                </div>
              </div>

              <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{$product->post_title}}</strong>
                    
                </div>
            </div>

              @endforeach
            
                
              </div>
              
               
              
              
              
              
              
              
              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </div>
          
        </form>

          <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    
                    format: 'YYYY-MM-DD'
                });
            });

            
        </script>    
   
