<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Item;
use App\Client;
use App\Employee;
use App\Category;
use App\Saleitem;
use Carbon\Carbon;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:sale-list|sale-create|sale-edit|sale-delete', ['only' => ['index','show']]);
         $this->middleware('permission:sale-create', ['only' => ['create','store']]);
         $this->middleware('permission:sale-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:sale-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::latest()->with('clients')->paginate(15);
        return view('sales.index',compact('sales'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('pageFamily','sales')
            ->with('keywords','');
    }


    public function salesreports()
    {
        $items = Item::get();
        $clients = Client::get();
        $categories = Category::with('children')->whereNull('parent')->get();
        $employees = Employee::get();

        $sales = Sale::latest()
            ->with('clients')
            ->with('saleitems')
            
            ->paginate(15);

            //dd($sales);
        return view('sales.reports',compact('sales','items','categories','clients','employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('pageFamily','salesreports')
            ->with('keywords','')
            ->with('client_id')
            ->with('category_id')
            ->with('item_id')
            ->with('fromdate')
            ->with('todate')
            ->with('employee_id');
    }




    public function filter(Request $request)
    {
        


        $items = Item::get();
        $clients = Client::get();
        $categories = Category::with('children')->whereNull('parent')->get();
        $employees = Employee::get();

        $sales= Sale::select('*')->with(['clients','saleitems']);

        $fields = ['item_id', 'category_id','client_id','employee_id','brand'];
        foreach($fields as $field){
            if(!empty($request->$field)){
                
                $sales->where($field, '=', $request->$field);
            }
        }

        if(!empty($request->fromdate) && !empty($request->todate)){
            $fromdate = $dateS = new Carbon($request->fromdate);
            $todate = new Carbon($request->todate);
            $sales->whereBetween('date',[$fromdate,$todate]);
       }
        
        
        $sales= $sales->paginate(15);

        //dd($clientrequests);


        return view('sales.reports',compact('sales','items','categories','clients','employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('pageFamily','sales')->with('keywords','')
            ->with('client_id',$request->client_id)
            ->with('category_id',$request->category_id)
            ->with('item_id',$request->item_id)
            ->with('fromdate',$request->fromdate)
            ->with('todate',$request->todate)
            ->with('employee_id',$request->employee_id)
            ;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create');
    }

    public function getAutocompleteData(Request $request){
        if($request->has('term')){
            return Client::where('name','like','%'.$request->input('term').'%')->get();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'client_id' => 'required',
            
        ]);

        
        
       $sale =  Sale::create($request->all());
       
       $item_id = request('item_id');
       $employee_id = request('employee_id');
       $expences = request('expences');
       $price = request('price');
       $empl_commision = request('empl_commision');
       $itemcount = $request->itemcount;
       $total = 0;

       //dd($item_id);

        foreach($item_id as $key => $value){
            Saleitem::create([
                'sale_id'=>$sale->id,
                'item_id'=>$value,
                'employee_id'=>$employee_id[$key],
                'price'=>$price[$key],
                'empl_commision'=>$empl_commision[$key],
                'expences'=>$expences[$key]
                ]
            );
            $total += $price[$key];
        }

        



    
            $sale->update(['total'=>$total]);
        return redirect()->route('sales.index')
                        ->with('success','Sale created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
         request()->validate([
            'client_id' => 'required',
            'item_id' => 'required',
            'employee_id' => 'required',
        ]);


        $sale->update($request->all());



       $item_id = request('item_id');
       $employee_id = request('employee_id');
       $expences = request('expences');
       $price = request('price');
       $empl_commision = request('empl_commision');
       $itemcount = $request->itemcount;
       $total = 0;
    
        $saleitems = Saleitem::where('sale_id',$sale->id)->with('sales')->get();
        foreach($saleitems as $saleitem){
            $saleitem->delete();
            
        }

       //dd($item_id);

        foreach($item_id as $key => $value){
            Saleitem::create([
                'sale_id'=>$sale->id,
                'item_id'=>$value,
                'employee_id'=>$employee_id[$key],
                'price'=>$price[$key],
                'empl_commision'=>$empl_commision[$key],
                'expences'=>$expences[$key]
                ]
            );
            $total += $price[$key];
        }

        



    
            $sale->update(['total'=>$total]);


        return redirect()->route('sales.index')
                        ->with('success','Sale updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $saleitems = Saleitem::where('sale_id',$sale->id)->with('sales')->get();
        foreach($saleitems as $saleitem){
            $saleitem->delete();
            
        }
        $sale->delete();


        return redirect()->route('sales.index')
                        ->with('success','Sale deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       //return view for specified action
       //if action is delete, call this view, etc...
        if($action=='edit'){
            $sale = Sale::find($id);
            $items = Item::get();
            $clients = Client::get();
            $saleitems = Saleitem::where('sale_id',$id)->with('sales')->get();
            $employees = Employee::get();
            return view('sales.modals.'.$action,compact('sale','items','clients','employees','saleitems'))->with('activePage','sales');

        }

        if($action=="create"){
            
            $items = Item::get();
            $clients = Client::get();
            $employees = Employee::get();
            
            return view('sales.modals.'.$action,compact('items','clients','employees'))->with('activePage');
        }

        if($action=="delete"){
            $sale = Sale::find($id);
            return view('sales.modals.'.$action,compact('sale'))->with('activePage','sales');
            

        }

        if($action=="show"){
            $sale = Sale::find($id);
            $saleitems = Saleitem::where('sale_id',$id)->with('sales')->get();
            $items = Item::get();
            $clients = Client::get();
            $employees = Employee::get();

            
            
            return view('sales.modals.'.$action,compact('sale','items','clients','employees','saleitems'))->with('activePage','sales');
        }

        
        
    }
}
