<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todolist;
use Carbon\Carbon;

class TodolistsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:todolist-list|todolist-create|todolist-edit|todolist-delete', ['only' => ['index','show']]);
         $this->middleware('permission:todolist-create', ['only' => ['create','store']]);
         $this->middleware('permission:todolist-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:todolist-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todolists = Todolist::latest()->paginate(15);
        return view('todolists.index',compact('todolists'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('pageFamily','todolists')
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
        return view('todolists.create');
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
            'date' => 'required',
        ]);

        
        Todolist::create($request->all());


        return redirect()->route('todolists.index')
                        ->with('success','Todolist created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function show(Todolist $todolist)
    {
        return view('todolists.show',compact('todolist'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function edit(Todolist $todolist)
    {
        return view('todolists.edit',compact('todolist'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todolist $todolist)
    {
         request()->validate([
            'name' => 'required',
            'date' => 'required',
        ]);


        $todolist->update($request->all());


        return redirect()->route('todolists.index')
                        ->with('success','Todolist updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todolist $todolist)
    {
        $todolist->delete();


        return redirect()->route('todolists.index')
                        ->with('success','Todolist deleted successfully');
    }


    public function filter(Request $request)
    {
        


        // $items = Item::get();
        // $clients = Client::get();
        // $categories = Category::with('children')->whereNull('parent')->get();
        // $employees = Employee::get();

        $todolists = Todolist::select('*');

        // $fields = ['item_id', 'category_id','client_id','employee_id'];
        // foreach($fields as $field){
        //     if(!empty($request->$field)){
        //         $sales->where($field, '=', $request->$field);
        //     }
        // }

        if(!empty($request->filtername)){
            
            //$sales->whereBetween('date',[$fromdate,$todate]);
            $todolists->orWhere('name', 'like', '%' . $request->filtername . '%');
       }

        if(!empty($request->fromdate)){
            $fromdate = new Carbon($request->fromdate);
            //$todate = new Carbon($request->todate);
            $todolists->where('date',$fromdate);
            //->whereBetween('date',[$fromdate,$todate]);
       }
        
        
        $todolists= $todolists->paginate(15);

        //dd($clientrequests);


        return view('todolists.index',compact('todolists'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('pageFamily','todolists')->with('keywords','')
            
            ->with('filtername',$request->filtername)
            ->with('fromdate',$request->fromdate)
            ->with('todate',$request->todate)
            
            ;
        
    }

    public function storeDone(Todolist $todolist, $id){
        $todo = Todolist::find($id);
        if($todo){
            $todo->stat = '1';
            $todo->save();
        }
        //dd($id);
        // $todolist->update(array('stat' => '1'));
        // dd($todolist);
        return redirect()->route('todolists.index')
                        ->with('success','To Do Task was successfully Done');
        
        
    }

    public function loadModal($action, $id=null)
    {
       //return view for specified action
       //if action is delete, call this view, etc...
        if($action=='edit'){
            $todolist = Todolist::find($id);
            
            return view('todolists.modals.'.$action,compact('todolist'))->with('activePage','todolists');

        }

        if($action=="create"){
            
            
            
            return view('todolists.modals.'.$action)->with('activePage');
        }

        if($action=="delete"){
            $todolist = Todolist::find($id);
            return view('todolists.modals.'.$action,compact('todolist'))->with('activePage','todolists');
            

        }

        if($action=="setDone"){
            $todolist = Todolist::find($id);
            return view('todolists.modals.'.$action,compact('todolist'))->with('activePage','todolists');
            

        }

        if($action=="show"){
            $todolist = Todolist::find($id);
            
            return view('todolists.modals.'.$action,compact('todolist'))->with('activePage','todolists');
        }

        
        
    }
}
