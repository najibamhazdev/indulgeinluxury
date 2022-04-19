
        <div class="row">
          <div class="col-lg-12 margin-tb">
              <div class="pull-left">
                  <h2>Create New Subscriber</h2></div>
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
          
          {!! Form::open(array('route' => 'subscribers.store','method'=>'POST')) !!}
          <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="fname">First Name</label>
                  <input type="text" name="fname" id="fname" class="form-control">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="lname">Last Name</label>
                  <input type="text" name="lname" id="lname" class="form-control">
                </div>
            </div>

              <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail">Email</label>
                    <input type="email" name="email" id="exampleInputEmail" class="form-control">
	              </div>
              </div>
              
              
              
              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </div>
          
          {!! Form::close() !!}
   
