
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Client Request</h2>
        </div>
        <div class="pull-right">
            <a class=" close-model" data-dismiss="modal" > <i class="fa fa-close"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Date:</strong> {{ $clientrequest->date }}
        </div>
    </div>

    @if($clientrequest->category_id)
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Category:</strong>  {{ $clientrequest->categories->name }}
        </div>
    </div>
    @endif

    
    @if($clientrequest->item_id)
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Item:</strong> {{ $clientrequest->items->name }} <strong>IN</strong> 
            @if($clientrequest->items->categories->parent) {{$clientrequest->items->categories->getparent->name}} / {{$clientrequest->items->categories->name}} @endif
        </div>
    </div>
    @endif

    <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Client:</strong> {{ $clientrequest->clients->name }}
            </div>
    </div>

       
        
    <div class="col-xs-12 col-sm-12 col-md-12">
        <table class="table  table-striped" id="user_table">
            <thead>
             <tr>
                 <th >Categories</th>
                 <th >Items</th>
                 
                
             </tr>
            </thead>
            <tbody >
                @foreach ($requestitems as $slitem)
                <tr>
                    
                    <td>{{$slitem->categories->name}}</td>
                    <td>{{$slitem->items->name}}</td>
                    
                </tr>
                @endforeach

            </tbody>

        </table>
    </div>

        

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong> {{ $clientrequest->details }}
            </div>
        </div>

        
    </div>
   
