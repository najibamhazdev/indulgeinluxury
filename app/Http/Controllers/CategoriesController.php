<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;
use App\Clientrequest;
use App\Item;


class CategoriesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
         $this->middleware('permission:category-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(15);
       
        return view('categories.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5)->with('pageFamily','categories')->with('keywords','');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            
        ]);

        
        Category::create($request->all());


        return redirect()->route('categories.index')
                        ->with('success','Category created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show',compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
         request()->validate([
            'name' => 'required',
            
        ]);


        $category->update($request->all());


        return redirect()->route('categories.index')
                        ->with('success','Category updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {   
        $categories = Category::where('parent',$category->id)->count();
        $requests = Clientrequest::where('category_id',$category->id)->count();
        $items = Item::where('category',$category->id)->count();
        $occure = $categories + $requests + $items;
        //dd($occure);
        if($occure > 0){
            return redirect()->route('categories.index')
                        ->with('failure','Category related to Other table, Can\'t be deleted');
                        

        }else{
            $category->delete();
        }


        return redirect()->route('categories.index')
                        ->with('success','Category deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       
        if($action=='edit'){
            $category = Category::find($id);
            $parents = Category::whereNull('parent')->with('getparent')->get();
        
            return view('categories.modals.'.$action,compact('category','parents'))->with('activePage','categories');

        }

        if($action=="create"){
            
            $parents = Category::whereNull('parent')->with('getparent')->get();
           
            return view('categories.modals.'.$action,compact('parents'))->with('activePage');
        }

        if($action=="delete"){
            $category = Category::find($id);
            return view('categories.modals.'.$action,compact('category'))->with('activePage','categories');
            

        }

        if($action=="show"){
            $category = Category::join("countries","categories.country","=","countries.id")->where("categories.id",$id)->get();
            
            return view('categories.modals.'.$action,compact('category'))->with('activePage','categories');
        }

        
        //return "yes";
    }
}
