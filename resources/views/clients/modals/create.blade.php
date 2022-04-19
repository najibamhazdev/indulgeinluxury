
        <div class="row">
          <div class="col-lg-12 margin-tb">
              <div class="pull-left">
                  <h2>Create New Client</h2></div>
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
          
          {!! Form::open(array('route' => 'clients.store','method'=>'POST')) !!}
          <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                      <strong>Name:</strong>
                      {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                  </div>
              </div>
              
               <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                      <strong>Email:</strong>
                      {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control', 'required')) !!}
                  </div>
              </div>
              
              <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                      <strong>Phone:</strong>
                      {!! Form::text('phone','', array('placeholder' => 'Phone Number','class' => 'form-control', 'required')) !!}
                  </div>
              </div>
              
              <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                      <strong>Country:</strong>
                      
                      {{-- {!! Form::text('country','', array('placeholder' => 'Country','class' => 'form-control', 'required')) !!} --}}
                      <select name="country" class="form-control select2-options" >
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}" >{{$country->country_name}}</option>
                        @endforeach
                      </select>  
                      {{-- {!! Form::select('countries[]', $countries,[], array('class' => 'form-control','multiple')) !!} --}}
                     
                  </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                      <strong>City:</strong>
                      {!! Form::text('city','', array('placeholder' => 'City','class' => 'form-control')) !!}
                  </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                      <strong>PO.Box:</strong>
                      {!! Form::text('pobox','', array('placeholder' => 'PO.Box','class' => 'form-control')) !!}
                  </div>
              </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                      <strong>Address:</strong>
                      {!! Form::textarea('address','', array('placeholder' => 'Address Details','class' => 'form-control')) !!}
                  </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                      <strong>Gender:</strong>
                      {!! Form::select('gender',array('Male'=>'Male','Female'=>'Female'), array('class' => 'form-control')) !!}
                  </div>
              </div>
              
              <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                      <strong>Date Of Birth:</strong>
                      <input class="date form-control datepicker" name="dob" id="datetimepicker1" type="text">
                        {{-- {{$naj}}--}}
                      {{-- {!! Form::select('countries[]', $countries,[], array('class' => 'form-control','multiple')) !!}  --}}
                      {{-- {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!} --}}
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