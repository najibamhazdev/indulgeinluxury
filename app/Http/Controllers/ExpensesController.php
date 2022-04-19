<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use Carbon\Carbon;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:expense-list|expense-create|expense-edit|expense-delete', ['only' => ['index','show']]);
         $this->middleware('permission:expense-create', ['only' => ['create','store']]);
         $this->middleware('permission:expense-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:expense-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest()->paginate(15);
        return view('expenses.index',compact('expenses'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('pageFamily','expenses')
            ->with('keywords','')
            ->with('fromdate')
            ->with('todate')
            ->with('filtername');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
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
            'name' => 'required',
            'amount' => 'required',
        ]);

        
        Expense::create($request->all());


        return redirect()->route('expenses.index')
                        ->with('success','Expense created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('expenses.show',compact('expense'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit',compact('expense'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
         request()->validate([
            'name' => 'required',
            'amount' => 'required',
        ]);


        $expense->update($request->all());


        return redirect()->route('expenses.index')
                        ->with('success','Expense updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();


        return redirect()->route('expenses.index')
                        ->with('success','Expense deleted successfully');
    }


    public function filter(Request $request)
    {
        


        // $items = Item::get();
        // $clients = Client::get();
        // $categories = Category::with('children')->whereNull('parent')->get();
        // $employees = Employee::get();

        $expenses = Expense::select('*');

        // $fields = ['item_id', 'category_id','client_id','employee_id'];
        // foreach($fields as $field){
        //     if(!empty($request->$field)){
        //         $sales->where($field, '=', $request->$field);
        //     }
        // }

        if(!empty($request->filtername)){
            
            //$sales->whereBetween('date',[$fromdate,$todate]);
            $expenses->orWhere('name', 'like', '%' . $request->filtername . '%');
       }

        if(!empty($request->fromdate) && !empty($request->todate)){
            $fromdate = $dateS = new Carbon($request->fromdate);
            $todate = new Carbon($request->todate);
            $expenses->whereBetween('date',[$fromdate,$todate]);
       }
        
        
        $expenses= $expenses->paginate(15);

        //dd($clientrequests);


        return view('expenses.index',compact('expenses'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('pageFamily','expenses')->with('keywords','')
            
            ->with('filtername',$request->filtername)
            ->with('fromdate',$request->fromdate)
            ->with('todate',$request->todate)
            
            ;
        
    }

    public function loadModal($action, $id=null)
    {
       //return view for specified action
       //if action is delete, call this view, etc...
        if($action=='edit'){
            $expense = Expense::find($id);
            
            return view('expenses.modals.'.$action,compact('expense'))->with('activePage','expenses');

        }

        if($action=="create"){
            
            
            
            return view('expenses.modals.'.$action)->with('activePage');
        }

        if($action=="delete"){
            $expense = Expense::find($id);
            return view('expenses.modals.'.$action,compact('expense'))->with('activePage','expenses');
            

        }

        if($action=="show"){
            $expense = Expense::find($id);
            
            return view('expenses.modals.'.$action,compact('expense'))->with('activePage','expenses');
        }

        
        
    }
}
