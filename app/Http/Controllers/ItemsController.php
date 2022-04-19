<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use DB;
use App\Category;
use App\Sale;
use App\Clientrequest;
use App\Brand;
use App\Saleitem;
use App\Requestitem;

class ItemsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:item-list|item-create|item-edit|item-delete', ['only' => ['index','show']]);
         $this->middleware('permission:item-create', ['only' => ['create','store']]);
         $this->middleware('permission:item-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:item-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::latest()->with('categories')->paginate(15);
        return view('items.index',compact('items'))
            ->with('i', (request()->input('page', 1) - 1) * 5)->with('pageFamily','items')->with('keywords','');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
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
            'category' => 'required',
        ]);

        

        Item::create($request->all());


        return redirect()->route('items.index')
                        ->with('success','Item created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show',compact('item'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items.edit',compact('item'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        request()->validate([
            'name' => 'required',
            'category' => 'required',
        ]);


        $item->update($request->all());


        return redirect()->route('items.index')
                        ->with('success','Item updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $sales = Saleitem::where('item_id',$item->id)->count();

        $requests = Requestitem::where('item_id',$item->id)->count();
        $occure = $sales + $requests;
        //dd($occure);
        if($occure > 0){
            return redirect()->route('items.index')
                        ->with('failure','Item related to Other table, Can\'t be deleted');
                        

        }else{
            $item->delete();
        }

        return redirect()->route('items.index')
                        ->with('success','Item deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       //return view for specified action
       //if action is delete, call this view, etc...
        if($action=='edit'){
            $item = Item::find($id);
            $categories = Category::with('children')->whereNull('parent')->get();
            $brands = Brand::get();
            return view('items.modals.'.$action,compact('item'))
                ->with('activePage','items')
                ->with('brands',$brands)
                ->withCategories($categories);

        }

        if($action=="create"){

            $categories = Category::with('children')->whereNull('parent')->get();
            $brands = Brand::get();

            return view('items.modals.'.$action)
            ->with('activePage')
            ->with('brands',$brands)
            ->withCategories($categories);
        }

        if($action=="delete"){
            $item = Item::find($id);
            return view('items.modals.'.$action,compact('item'))->with('activePage','items');
            //return View::make('users.modals.'.$action)->render()->with('user',$user);

        }

        if($action=="show"){
            $item = Item::find($id);
            $categories = Category::with('children')->whereNull('parent')->get();
            
            return view('items.modals.'.$action,compact('item'))->with('activePage','items')->withCategories($categories);;
        }

        
        
    }

}
