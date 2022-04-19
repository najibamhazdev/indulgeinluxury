<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;

class NewsLetterController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:newsletter-list|newsletter-create|newsletter-edit|newsletter-delete', ['only' => ['index','show']]);
         $this->middleware('permission:newsletter-create', ['only' => ['create','store']]);
         $this->middleware('permission:newsletter-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:newsletter-delete', ['only' => ['destroy']]);
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
            'email' => 'required',
            
        ]);
        if(! Newsletter::isSubscribed($request->email)){
            Newsletter::subscribePending($request->email);
            return redirect()->route('newsletter.index')
                        ->with('success','Email Subscribed successfully.');
        }

        
        // Category::create($request->all());


        return redirect()->route('newsletter.index')
                        ->with('failure','Sorry, Email already exist.');
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
        $category->delete();


        return redirect()->route('categories.index')
                        ->with('success','Category deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       //return view for specified action
       //if action is delete, call this view, etc...
        if($action=='edit'){
            $category = Category::find($id);
            $parents = Category::whereNull('parent')->with('parent')->get();
        
            return view('categories.modals.'.$action,compact('category','parents'))->with('activePage','categories');

        }

        if($action=="create"){
            
            //$parents = Category::whereNull('parent')->with('parent')->get();
           
            return view('subscribers.modals.'.$action)->with('activePage');
        }

        if($action=="delete"){
            $category = Category::find($id);
            return view('categories.modals.'.$action,compact('category'))->with('activePage','categories');
            //return View::make('users.modals.'.$action)->render()->with('user',$user);

        }

        if($action=="show"){
            $category = Category::join("countries","categories.country","=","countries.id")->where("categories.id",$id)->get();
            //$client = Client::where('id','=',$id)->get();
            //$client = Client::find($id);
            //dd($client);
            return view('categories.modals.'.$action,compact('category'))->with('activePage','categories');
        }

        
        //return "yes";
    }
}
