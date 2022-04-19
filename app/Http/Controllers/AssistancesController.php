<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Assistance;
class AssistancesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:assistance-list|assistance-create|assistance-edit|assistance-delete', ['only' => ['index','show']]);
         $this->middleware('permission:assistance-create', ['only' => ['create','store']]);
         $this->middleware('permission:assistance-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:assistance-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assistances = Assistance::latest()->with('countries')->paginate(15);
        return view('assistances.index',compact('assistances'))
            ->with('i', (request()->input('page', 1) - 1) * 5)->with('pageFamily','assistances')->with('keywords','');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assistances.create');
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
            'email' => 'required',
        ]);

        $email = $request->email;
        $assistance = Assistance::where('email','=',$email)->first();
        
        if($assistance){
            //dd($assistance->id);
            return redirect()->route('assistances.index')
                        ->with('success','Assistance already exist.');
        }

        Assistance::create($request->all());


        return redirect()->route('assistances.index')
                        ->with('success','Assistance created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function show(Assistance $assistance)
    {
        return view('assistances.show',compact('assistance'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function edit(Assistance $assistance)
    {
        return view('assistances.edit',compact('assistance'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assistance $assistance)
    {
         request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);


        $assistance->update($request->all());


        return redirect()->route('assistances.index')
                        ->with('success','Sale Assistant updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assistance $assistance)
    {
        $assistance->delete();


        return redirect()->route('assistances.index')
                        ->with('success','Sale Assistant deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       //return view for specified action
       //if action is delete, call this view, etc...
        if($action=='edit'){
            $assistance = Assistance::find($id);
            $countries = Country::get();
            $jobs = array('Sales','Accountant','Other');
            return view('assistances.modals.'.$action,compact('assistance','countries','jobs'))->with('activePage','assistances');

        }

        if($action=="create"){
            
            $countries = Country::get();
            $jobs = array('Sales','Accountant','Other');
            return view('assistances.modals.'.$action)->with('activePage')->with('countries',$countries)->with('jobs',$jobs);
        }

        if($action=="delete"){
            $assistance = Assistance::find($id);
            return view('assistances.modals.'.$action,compact('assistance'))->with('activePage','assistances');
            //return View::make('users.modals.'.$action)->render()->with('user',$user);

        }

        if($action=="show"){
            $assistance = Assistance::join("countries","assistances.country","=","countries.id")->where("assistances.id",$id)->get();
            
            return view('assistances.modals.'.$action,compact('assistance'))->with('activePage','assistances');
        }

        
        
    }
}
