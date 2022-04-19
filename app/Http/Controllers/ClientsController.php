<?php


namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use DB;
use Newsletter;
use App\Sale;
use App\Clientrequest;


class ClientsController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:client-list|client-create|client-edit|client-delete', ['only' => ['index','show']]);
         $this->middleware('permission:client-create', ['only' => ['create','store']]);
         $this->middleware('permission:client-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:client-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->with('countries')->paginate(15);
        return view('clients.index',compact('clients'))
            ->with('i', (request()->input('page', 1) - 1) * 5)->with('pageFamily','clients')->with('keywords','');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
        $client = Client::where('email','=',$email)->first();
        
        if($client){
            //dd($client->id);
            return redirect()->route('clients.index')
                        ->with('success','Client already exist.');
        }

        Client::create($request->all());
        if(! Newsletter::isSubscribed($email)){
            Newsletter::subscribe($email, ['FNAME'=>$request->name, 'LNAME'=>'']);
        }
        return redirect()->route('clients.index')
                        ->with('success','Client created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show',compact('client'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
         request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);


        $client->update($request->all());


        return redirect()->route('clients.index')
                        ->with('success','Client updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {   
        $sales = Sale::where('client_id',$client->id)->count();
        $requests = Clientrequest::where('client_id',$client->id)->count();
        $occure = $sales + $requests;
        //dd($occure);
        if($occure > 0){
            return redirect()->route('clients.index')
                        ->with('failure','Client related to Other table, Can\'t be deleted');
                        

        }else{
           $client->delete();
        }

        return redirect()->route('clients.index')
                        ->with('success','Client deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       //return view for specified action
       //if action is delete, call this view, etc...
        if($action=='edit'){
            $client = Client::find($id);
            $countries = DB::table('countries')->get();
            //$clientCountry = $client->countries->pluck('name','name')->all();
            return view('clients.modals.'.$action,compact('client'))->with('activePage','clients')->with('countries',$countries);

        }

        if($action=="create"){
            //$user = User::find($id);
            $countries = DB::table('countries')->get();
            //dd($countries);
            //$userRole = $user->roles->pluck('name','name')->all();
            return view('clients.modals.'.$action)->with('activePage')->with('countries',$countries);
        }

        if($action=="delete"){
            $client = Client::find($id);
            return view('clients.modals.'.$action,compact('client'))->with('activePage','clients');
            //return View::make('users.modals.'.$action)->render()->with('user',$user);

        }

        if($action=="show"){
            $client = Client::join("countries","clients.country","=","countries.id")->where("clients.id",$id)->get();
            //$client = Client::where('id','=',$id)->get();
            //$client = Client::find($id);
            //dd($client);
            return view('clients.modals.'.$action,compact('client'))->with('activePage','clients');
        }

        
        
    }

}