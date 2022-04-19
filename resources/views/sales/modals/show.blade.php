
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Sale Operation</h2>
        </div>
        <div class="pull-right">
            <a class=" close-model" data-dismiss="modal" > <i class="fa fa-close"></i></a>
        </div>
    </div>
</div>

<div class="row">
   

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Date:</strong> {{ $sale->date }}
        </div>
    </div>
    

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Client:</strong> {{ $sale->clients->name }}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Total: </strong> {{ $sale->total }} $
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
                    
                 </tr>
                </thead>
                <tbody >
                    @foreach ($saleitems as $slitem)
                    <tr>
                        <td>{{$slitem->items->name}}</td>
                        <td>{{$slitem->price}}</td>
                        <td>{{$slitem->expences}}</td>
                        <td>{{$slitem->employees->name}}</td>
                        <td>{{$slitem->empl_commision}}</td>
                    </tr>
                    @endforeach
 
                </tbody>

            </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Shipping Address:</strong> {{ $sale->shipping_to }}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Shipping Cost ($):</strong> {{ $sale->shipping_cost }}
            </div>
        </div>
        


        

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong> {{ $sale->details }}
            </div>
        </div>

        
    </div>
   
