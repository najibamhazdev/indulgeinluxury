<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Clientrequest;


class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:brand-list|brand-create|brand-edit|brand-delete', ['only' => ['index','show']]);
         $this->middleware('permission:brand-create', ['only' => ['create','store']]);
         $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(15);
       
        return view('brands.index',compact('brands'))
            ->with('i', (request()->input('page', 1) - 1) * 5)->with('pageFamily','brands')->with('keywords','');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
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

        
        Brand::create($request->all());


        return redirect()->route('brands.index')
                        ->with('success','Brand created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('brands.show',compact('brand'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit',compact('brand'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
         request()->validate([
            'name' => 'required',
            
        ]);


        $brand->update($request->all());


        return redirect()->route('brands.index')
                        ->with('success','Brand updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {   
        //$brands = Brand::where('parent',$brand->id)->count();
        //$requests = Clientrequest::where('brand_id',$brand->id)->count();
        $items = Item::where('brand',$brand->id)->count();
        $occure =  $items;
        //dd($occure);
        if($occure > 0){
            return redirect()->route('brands.index')
                        ->with('failure','Brand related to Other table, Can\'t be deleted');
                        

        }else{
            $brand->delete();
        }


        return redirect()->route('brands.index')
                        ->with('success','Brand deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       
        if($action=='edit'){
            $brand = Brand::find($id);
            
        
            return view('brands.modals.'.$action,compact('brand'))->with('activePage','brands');

        }

        if($action=="create"){
            
           
           
            return view('brands.modals.'.$action)->with('activePage');
        }

        if($action=="delete"){
            $brand = Brand::find($id);
            return view('brands.modals.'.$action,compact('brand'))->with('activePage','brands');
            

        }

        if($action=="show"){
            $brand = Brand::where("brands.id",$id)->get();
            
            return view('brands.modals.'.$action,compact('brand'))->with('activePage','brands');
        }

        
        //return "yes";
    }
}
