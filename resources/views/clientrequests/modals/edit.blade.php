
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Client Request</h2>
            
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

{!! Form::model($clientrequest, ['method' => 'PATCH','route' => ['clientrequests.update', $clientrequest->id]]) !!}

<div class="row">
    

     <div class="col-xs-6 col-sm-6 col-md-6">
      <div class="form-group">
          <strong>Client Name:</strong>
         
          <select name="client_id" class="form-control select2-options" >
              @foreach ($clients as $client)
              <option value="{{$client->id}}" @if($clientrequest->client_id == $client->id) selected @endif >{{$client->name}}</option>
              @endforeach
          </select>
          
      </div>
      </div>
      
     
      <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
              <strong>Date :</strong>
          <input class="date form-control datepicker" name="date" value="{{$clientrequest->date}}" id="datetimepicker1" type="text">
              
          </div>
      </div>
    
     
      
      <div class="col-xs-12 col-sm-12 col-md-12">
        <table class="table  table-striped" id="user_table">
            <thead>
             <tr>
                <th>Category</th> 
                <th >Item</th>
                <th>Action</th>
                
             </tr>
            </thead>
            <tbody id="dynamic_fields">
                <?php 
                    $count=0;
                ?>
                @foreach ($requestitems as $requestitem)
                <?php
                    $count++;
                ?>
                

                <tr>
                    <td><select class="form-control select2-options" name="category_id[]" >
                        <option value="">Select a Category</option>
                
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id === $requestitem->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @if ($category->children)
                                @foreach ($category->children as $child)
                                    <option value="{{ $child->id }}" {{ $child->id === $requestitem->category_id ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select></td>

                    <td>
                        <select name="item_id[]" class="form-control select2-options" ><option>Select Item</option>
                          @foreach ($items as $item)
                          <option value="{{$item->id}}" @if($requestitem->item_id == $item->id) selected @endif  >{{$item->name}}</option>
                          @endforeach
                        </select>  </td>
    
    
                        @if($count > 1)
                        
                            <td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>
                            
                        
                        @else
                           
                            <td><button type="button" name="add" id="add" class="btn btn-success">+</button></td></tr>
                            
                        @endif



                @endforeach

            </tbody>

        </table>
    </div>  
                  
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Details:</strong>
            {!! Form::textarea('details',$clientrequest->details, array('placeholder' => 'clientrequest Details','class' => 'form-control')) !!}
        </div>
          </div>
   
    
    
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

<script>
    $(document).ready(function(){
    
    var count = <?=$count?>;
    
     dynamic_field(count);
    
     function dynamic_field(number)
     {
        //alert('function called');
      html = '<tr>';

        html += '<td><select class="form-control select2-options" name="category_id[]"  ><option value="">Select a Category</option>';
                                   
                  @foreach ($categories as $category)
                    html += '<option value="{{ $category->id }}" >{{ $category->name }}</option>';
                      
                  @endforeach
                  
        html += '</select></td>';



        html += '<td><select name="item_id[]" class="form-control select2-options" ><option>Select Item</option>';
              @foreach ($items as $item)
              html +=  '<option value="{{$item->id}}" >{{$item->name}}</option>';
              @endforeach
        html += '</select>  </td>';

         
            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                $('#dynamic_fields').append(html);
            }
            else
            {   
                html += '<td><button type="button" name="add" id="add" class="btn btn-success">+</button></td></tr>';
                $('#dynamic_fields').html(html);
            }
     }
    
     $(document).on('click', '#add', function(){
      count++;
     // alert(count)
      dynamic_field(count);
      document.getElementById("itemcount").value=count;
     });
    
     $(document).on('click', '.remove', function(){
      count--;
      $(this).closest("tr").remove();
      document.getElementById("itemcount").value=count;
     });
    
     $('#dynamic_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:'{{ route("sales.store") }}',
                method:'post',
                data:$(this).serialize(),
                dataType:'json',
                beforeSend:function(){
                    $('#save').attr('disabled','disabled');
                },
                success:function(data)
                {
                    if(data.error)
                    {
                        var error_html = '';
                        for(var count = 0; count < data.error.length; count++)
                        {
                            error_html += '<p>'+data.error[count]+'</p>';
                        }
                        $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                    }
                    else
                    {
                        dynamic_field(1);
                        $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                    }
                    $('#save').attr('disabled', false);
                }
            })
     });
    
    });

    $(document).ready(function(){
                $('.select2-options').select2({
                    dropdownParent: $("#myModal")
                });;
        });
    </script>