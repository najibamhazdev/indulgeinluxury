<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Campaign;
use App\Emailtemplate;
use App\Producttemplate;

use \DrewM\MailChimp\MailChimp;
use Newsletter;
use Illuminate\Support\Facades\Mail;


class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:campaign-list|campaign-create|campaign-edit|campaign-delete', ['only' => ['index','show']]);
         $this->middleware('permission:campaign-create', ['only' => ['create','store']]);
         $this->middleware('permission:campaign-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:campaign-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::with('templates')->latest()->paginate(15);
       
        return view('campaigns.index',compact('campaigns'))
            ->with('i', (request()->input('page', 1) - 1) * 5)->with('pageFamily','campaigns')->with('keywords','');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaigns.create');
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

        
        Campaign::create($request->all());


        return redirect()->route('campaigns.index')
                        ->with('success','Campaign created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        return view('campaigns.show',compact('campaign'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('campaigns.edit',compact('campaign'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
         request()->validate([
            'name' => 'required',
            
        ]);


        $campaign->update($request->all());


        return redirect()->route('campaigns.index')
                        ->with('success','Campaign updated successfully');
    }


    public function send(Campaign $campaign, $id)
    {  
        $campaign = Campaign::findOrFail($id);
        
        //$members = Newsletter::getMembers()['total_items'];
        

        $total =  Newsletter::getMembers()['total_items'];

        $parameters = ['count' => $total];

        $members = Newsletter::getMembers($string = '', $parameters)['members'];
        $subs=array();
        $email="";
        for($i=0;  $i < $total; $i++){
            $email = $members[$i]['email_address'];
            $name=$members[$i]['merge_fields']['FNAME']." ".$members[$i]['merge_fields']['LNAME'];
            $sub= ['name'=>$name,'email'=>$email];
            array_push($subs, $sub);
            
            }

            $emailtemplate = Emailtemplate::find($campaign->template);
            $producttemplates = Producttemplate::where('emailtemplate_id',$campaign->template)->get();    

        $data =[
            'emailtemplate'=>$emailtemplate,
            'producttemplates'=>$producttemplates
        ];
        //dd($data);
        $emails=[["name"=>"Najib A","email"=>"najib@lebsiting.com"],["name"=>"Najib B","email"=>"dev@lebsiting.com"],["name"=>"Najib C","email"=>"sales@skyourhost.com"]];
        //$emails = ['najib@lebsiting.com', 'najibamhaz@gmail.com','dev@lebsiting.com'];
        foreach($emails as $key => $value){
            //dd($emails[$key]['name']);
            Mail::send('email_templates.template1',compact('emailtemplate','producttemplates'), function($message) use ($emails,$campaign,$key){
                $message->to($emails[$key]['email'],$emails[$key]['name'])->subject($campaign->subject);
            });
        }

        $campaign->status = 1;
        $campaign->save();
        
        //return $subs;
        return redirect()->route('campaigns.index')
                        ->with('success','Campaign was sent successfully');

     }


     public function sendpreview(Campaign $campaign, $id, Request $request)
     {  
        $campaign = Campaign::findOrFail($id);
        $email= $request->email;
        
        $emailtemplate = Emailtemplate::find($campaign->template);
        $producttemplates = Producttemplate::where('emailtemplate_id',$campaign->template)->get();    

    $data =[
        'emailtemplate'=>$emailtemplate,
        'producttemplates'=>$producttemplates
    ];

        Mail::send('email_templates.template1',compact('emailtemplate','producttemplates'), function($message) use ($email,$campaign){
            $message->to($email)->subject($campaign->subject);
        });
        return redirect()->route('campaigns.index')
        ->with('success','Campaign was sent successfully');
     }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {   
        $campaigns = Campaign::where('parent',$campaign->id)->count();
       // $requests = Clientrequest::where('category_id',$category->id)->count();
        $items = Item::where('category',$category->id)->count();
        $occure = $campaigns + $requests + $items;
        //dd($occure);
        if($occure > 0){
            return redirect()->route('campaigns.index')
                        ->with('failure','Campaign related to Other table, Can\'t be deleted');
                        

        }else{
            $campaign->delete();
        }


        return redirect()->route('campaigns.index')
                        ->with('success','Campaign deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       
        if($action=='edit'){
            $campaign = Campaign::find($id);
            
            $emailtemplates = Emailtemplate::orderBy("id", "desc")->get();
            return view('campaigns.modals.'.$action,compact('campaign','emailtemplates'))->with('activePage','campaigns');

        }

        if($action=="create"){
            
          
            $emailtemplates = Emailtemplate::orderBy("id", "desc")->get();
            return view('campaigns.modals.'.$action,compact('emailtemplates'))->with('activePage');
        }

        if($action=="delete"){
            $campaign = Campaign::find($id);
            return view('campaigns.modals.'.$action,compact('campaign'))->with('activePage','campaigns');
            

        }
        if($action=="send"){
            $campaign = Campaign::find($id);
            return view('campaigns.modals.'.$action,compact('campaign'))->with('activePage','campaigns');
            
        }

        if($action=="preview"){
            $campaign = Campaign::find($id);
            return view('campaigns.modals.'.$action,compact('campaign'))->with('activePage','campaigns');
            
        }

        if($action=="show"){
            
            
            return view('campaigns.modals.'.$action,compact('campaign'))->with('activePage','campaigns');
        }

        
        //return "yes";
    }
}
