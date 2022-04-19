<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientrequest;
use App\Item;
use App\Client;
use App\Category;
use App\Requestitem;
use DB;

class ClientrequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:clientrequest-list|clientrequest-create|clientrequest-edit|clientrequest-delete', ['only' => ['index','show']]);
         $this->middleware('permission:clientrequest-create', ['only' => ['create','store']]);
         $this->middleware('permission:clientrequest-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:clientrequest-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::get();
        $clients = Client::get();
        $categories = Category::with('children')->whereNull('parent')->get();
        $clientrequests = Clientrequest::latest()->with('clients')->with('requestitems')->paginate(15);
        return view('clientrequests.index',compact('clientrequests','items','categories','clients'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('pageFamily','clientrequests')
            ->with('keywords','')
            ->with('client_id')
            ->with('category_id')
            ->with('item_id');

        //return "yes";

            
    }

    public function filter(Request $request)
    {
        


        $items = Item::get();
        $clients = Client::get();
        $categories = Category::with('children')->whereNull('parent')->get();
        
        $clientrequests= Clientrequest::select('*')->with(['clients','requestitems']);

        if(!empty($request->item_id)){
            $item_id = $request->item_id;
           // $inprogress = Requestitem::where('item_id','=',$request->item_id)->get();
            
            //$clientrequests->join('requestitems','requestitems.clientrequest_id','=','clientrequests.id')->where('requestitems.item_id','=',$request->item_id);
            //join('posts', 'users.id', '=', 'posts.user_id')
            $clientrequests->whereHas('requestitems', function ($query) {
                $query->where('item_id','=', $item_id);
            });

            
  
        }

        $fields = ['client_id'];
        foreach($fields as $field){
            if(!empty($request->$field)){
                $clientrequests->where($field, '=', $request->$field);
            }
        }
        
        
        $clientrequests= $clientrequests->paginate(15);

        
        return view('clientrequests.index',compact('clientrequests','items','categories','clients'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('pageFamily','clientrequests')->with('keywords','')
            ->with('client_id',$request->client_id)
            ->with('category_id',$request->category_id)
            ->with('item_id',$request->item_id);
        
    }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientrequests.create');
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

        

        $clientrequest = Clientrequest::create($request->all());
        

       $item_id = request('item_id');
       $category_id = request('category_id');
       
       $itemcount = $request->itemcount;
       $total = 0;

       
        if($item_id){
            //dd($clientrequest->id);   
            foreach($item_id as $key => $value){
                Requestitem::create([
                    'clientrequest_id'=>$clientrequest->id,
                    'item_id'=>$value,
                    'category_id'=>$category_id[$key]
                    ]
                );
                
            }
       }else{

        if($category_id){
            foreach($category_id as $key => $value){
                Requestitem::create([
                    'clientrequest_id'=>$clientrequest->id,
                    'item_id'=>$item_id[$key],
                    'category_id'=>$value
                    ]
                );
                
            }
       }
       }

        return redirect()->route('clientrequests.index')
                        ->with('success','Clientrequest created successfully.');
    }


   
    public function update(Request $request, Clientrequest $clientrequest)
    {
         request()->validate([
            'client_id' => 'required',
            
        ]);


        $clientrequest->update($request->all());


        $item_id = request('item_id');
        $category_id = request('category_id');
        
        $itemcount = $request->itemcount;
        $total = 0;
            
        $requestitems = Requestitem::where('clientrequest_id',$clientrequest->id)->get();
        foreach($requestitems as $requestitem){
            $requestitem->delete();
            
        }
        
         if($item_id){
             //dd($clientrequest->id);   
             foreach($item_id as $key => $value){
                 Requestitem::create([
                     'clientrequest_id'=>$clientrequest->id,
                     'item_id'=>$value,
                     'category_id'=>$category_id[$key]
                     ]
                 );
                 
             }
        }else{
 
         if($category_id){
             foreach($category_id as $key => $value){
                 Requestitem::create([
                     'clientrequest_id'=>$clientrequest->id,
                     'item_id'=>$item_id[$key],
                     'category_id'=>$value
                     ]
                 );
                 
             }
        }
        }



        return redirect()->route('clientrequests.index')
                        ->with('success','Clientrequest updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientrequest $clientrequest)
    {
        $requestitems = Requestitem::where('clientrequest_id',$clientrequest->id)->get();
        foreach($requestitems as $requestitem){
            $requestitem->delete();
            
        }
        $clientrequest->delete();


        return redirect()->route('clientrequests.index')
                        ->with('success','Clientrequest deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       //return view for specified action
       //if action is delete, call this view, etc...
        if($action=='edit'){
            $clientrequest = Clientrequest::find($id);
            $items = Item::get();
            $clients = Client::get();
            $categories = Category::with('children')->whereNull('parent')->get();
            $requestitems = Requestitem::where('clientrequest_id',$id)->with('clientrequest')->get();
            return view('clientrequests.modals.'.$action,compact('clientrequest','items','clients','categories','requestitems'))->with('activePage','clientrequests');

        }

        if($action=="create"){
            
            $items = Item::get();
            $clients = Client::get();
            $categories = Category::with('children')->whereNull('parent')->get();
            return view('clientrequests.modals.'.$action,compact('items','clients','categories'))->with('activePage');
        }

        if($action=="delete"){
            $clientrequest = Clientrequest::find($id);
            return view('clientrequests.modals.'.$action,compact('clientrequest'))->with('activePage','clientrequests');
            

        }

        if($action=="show"){
            $clientrequest = Clientrequest::find($id);
            $requestitems = Requestitem::where('clientrequest_id',$id)->get();
            $items = Item::get();
            $clients = Client::get();
            $categories = Category::with('children')->whereNull('parent')->get();

            
            
            return view('clientrequests.modals.'.$action,compact('requestitems','clientrequest','items','clients','categories'))->with('activePage','clientrequests');
        }

        
        
    }
}
