
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Sale Operation Info</h2>
            
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

{!! Form::model($sale, ['method' => 'PATCH','route' => ['sales.update', $sale->id]]) !!}

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Item:</strong>
            
            
          <select name="item_id" class="form-control" >
            @foreach ($items as $item)
                <option value="{{$item->id}}" @if($sale->item_id == $item->id) selected @endif >{{$item->name}}</option>
            @endforeach
          </select>  
        </div>
    </div>

     <div class="col-xs-6 col-sm-6 col-md-6">
      <div class="form-group">
          <strong>Client Name:</strong>
         
          <select name="client_id" class="form-control" >
              @foreach ($clients as $client)
              <option value="{{$client->id}}" @if($sale->client_id == $client->id) selected @endif >{{$client->name}}</option>
              @endforeach
          </select>
          
      </div>
      </div>
      
      <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
              <strong>Date :</strong>
          <input class="date form-control datepicker" name="date" value="{{$sale->date}}" id="datetimepicker1" type="text">
              
          </div>
      </div>


      <div class="col-xs-12 col-sm-12 col-md-12">
        <table class="table  table-striped" id="user_table">
            <thead>
             <tr>
                 <th >Item</th>
                 <th >Price</th>
                 <th>Expences</th>
                 <th>Employee</th>
                 <th>Commission</th>
                 <th>Action</th>
                
             </tr>
            </thead>
            <tbody id="dynamic_fields">
                <?php 
                    $count=0;
                ?>
                @foreach ($saleitems as $slitem)
                <?php
                    $count++;
                ?>
                

                <tr>
                    <td>
                        <select name="item_id[]" class="form-control" ><option>Select Item</option>
                          @foreach ($items as $item)
                          <option value="{{$item->id}}" @if($slitem->item_id == $item->id) selected @endif  >{{$item->name}}</option>
                          @endforeach
                        </select>  </td>
    
                        <td><input type="text" name="price[]" value="{{$slitem->price}}" placeholder="Price" class="form-control" /></td>
                        <td><input type="text" name="expences[]" value="{{$slitem->expences}}" placeholder="Expenses" class="form-control" /></td>
    
                        <td><select name="employee_id[]" class="form-control" ><option>Select Employee</option>
                                               
                              @foreach ($employees as $employee)
                                <option value="{{$employee->id}}" @if($slitem->employee_id == $employee->id) selected @endif>{{$employee->name}}</option>      
                              @endforeach
                              
                        </select></td> 
                        <td><input type="text" name="empl_commision[]" value="{{$slitem->empl_commision}}" placeholder="Employee Commission" class="form-control" /></td>
    
                        @if($count > 1)
                        
                            <td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>
                            
                        
                        @else
                           
                            <td><button type="button" name="add" id="add" class="btn btn-success">+</button></td></tr>
                            
                        @endif



                @endforeach

            </tbody>

        </table>
    </div>
    
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Shipping To:</strong>
            <input class=" form-control" value="{{$sale->shipping_to}}" placeholder="Shipping Address" name="shipping_to"  type="text">
                
            </div>
        </div>
    
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Shipping Cost ($):</strong>
                {!! Form::text('shipping_cost', $sale->shipping_cost, array('placeholder' => 'Shipping Cost','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {!! Form::textarea('details',$sale->details, array('placeholder' => 'Sale Details','class' => 'form-control')) !!}
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
    
     //dynamic_field(count);
    
     function dynamic_field(number)
     {
        // alert('function called');
      html = '<tr>';
        html += '<td><select name="item_id[]" class="form-control" ><option>Select Item</option>';
              @foreach ($items as $item)
              html +=  '<option value="{{$item->id}}" >{{$item->name}}</option>';
              @endforeach
            html += '</select>  </td>';

            html += '<td><input type="text" name="price[]" placeholder="Price" class="form-control" /></td>';
            html += '<td><input type="text" name="expences[]" placeholder="Expenses" class="form-control" /></td>';

            html += '<td><select name="employee_id[]" class="form-control" ><option>Select Employee</option>';
                                   
                  @foreach ($employees as $employee)
                    html += '<option value="{{$employee->id}}" >{{$employee->name}}</option>';      
                  @endforeach
                  
            html += '</select></td>'; 
            html += '<td><input type="text" name="empl_commision[]" placeholder="Employee Commission" class="form-control" /></td>';

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
    </script>