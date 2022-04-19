<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DrewM\MailChimp\MailChimp;


use Newsletter;
use Spatie\Permission\Models\Role;

class SubscribersController extends Controller
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
        //Role::orderBy('id','DESC')->paginate(15);//
        $MailChimp = new MailChimp(env('MAILCHIMP_APIKEY'));
        $data = $MailChimp->get('lists');
        //dd($data['lists']);
        //return "yes";


        //----------------------
        $api_key = env('MAILCHIMP_APIKEY');
        $list_id = env('MAILCHIMP_LIST_ID');
        $dc = substr($api_key,strpos($api_key,'-')+1); // us5, us8 etc
        
        // URL to connect
        $url = 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id;
        
        // connect and get results
        $body = json_decode( rudr_mailchimp_curl_connect( $url, 'GET', $api_key ) );
        
        // number of members in this list
        $member_count = $body->stats->member_count;
        $emails = array();
        
        for( $offset = 0; $offset < $member_count; $offset += 50 ) :
        
            $data = array(
                'offset' => $offset,
                'count'  => 50
            );
        
            // URL to connect
            $url = 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members';
        
            // connect and get results
            $body = json_decode( rudr_mailchimp_curl_connect( $url, 'GET', $api_key, $data ) );
            
            foreach ( $body->members as $member ) {
                $emails[] = [$member->email_address,$member->merge_fields->FNAME." ".$member->merge_fields->LNAME,$member->status];
                //$names[] = $member->merge_fields->FNAME." ".$member->merge_fields->LNAME;
            }
        
        endfor;
        $subscribs = $body->members;

        //-------------------------

        //dd($emails);
       // dd($emails);

        return view('subscribers.index',compact('emails'))->with('i', (request()->input('page', 1) - 1) * 5)->with('pageFamily','subscribers')->with('keywords','');
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
            //Newsletter::subscribePending($request->email);
            Newsletter::subscribe($request->email, ['FNAME'=>$request->fname, 'LNAME'=>$request->lname]);
            return redirect()->route('subscribers.index')
                        ->with('success','Email Subscribed successfully.');
        }

        
        // Category::create($request->all());


        return redirect()->route('subscribers.index')
                        ->with('failure','Sorry, Email already exist.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(String $email)
    {
        return $email;
        //return view('subscribers.show',compact('category'));
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
    public function update(Request $request)
    {
         request()->validate([
            'email' => 'required',
            
        ]);

        Newsletter::subscribeOrUpdate($request->email, ['FNAME'=>$request->fname, 'LNAME'=>$request->lname]);

        //$category->update($request->all());


        return redirect()->route('subscribers.index')
                        ->with('success','Subscriber updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $email)
    {
        //$category->delete();
        Newsletter::unsubscribe($email);
        Newsletter::delete($email);
        return redirect()->route('subscribers.index')
                        ->with('success','Email deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       //return view for specified action
       //if action is delete, call this view, etc...
        if($action=='edit'){
            $email = $id;
            $member = Newsletter::getMember($id);
            //$parents = Category::whereNull('parent')->with('parent')->get();
            //dd($member);
            return view('subscribers.modals.'.$action,compact('member'))->with('activePage','subscribers');

        }

        if($action=="create"){
            
            //$parents = Category::whereNull('parent')->with('parent')->get();
           
            return view('subscribers.modals.'.$action)->with('activePage');
        }

        if($action=="delete"){
            $email = $id;
            return view('subscribers.modals.'.$action,compact('email'))->with('activePage','subscribers');
            //return View::make('users.modals.'.$action)->render()->with('user',$user);

        }

        if($action=="show"){
            $category = $id;//Category::join("countries","categories.country","=","countries.id")->where("categories.id",$id)->get();
            //$client = Client::where('id','=',$id)->get();
            //$client = Client::find($id);
            //dd($client);

            //---------start--------------
            //----------------------
        $api_key = env('MAILCHIMP_APIKEY');
        $list_id = env('MAILCHIMP_LIST_ID');
        $dc = substr($api_key,strpos($api_key,'-')+1); // us5, us8 etc
        
        // URL to connect
        $url = 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id;
        
        // connect and get results
        $body = json_decode( rudr_mailchimp_curl_connect( $url, 'GET', $api_key ) );
        
        // number of members in this list
        $member_count = $body->stats->member_count;
        $emails = array();
        
        for( $offset = 0; $offset < $member_count; $offset += 50 ) :
        
            $data = array(
                'offset' => $offset,
                'count'  => 50
            );
        
            // URL to connect
            $url = 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members';
        
            // connect and get results
            $body = json_decode( rudr_mailchimp_curl_connect( $url, 'GET', $api_key, $data ) );
            
            foreach ( $body->members as $member ) {
                if($member->email_address == $id){
                   $subscriber = $member; 
                    
                }

                
                //$emails[] = [$member->email_address,$member->merge_fields->FNAME." ".$member->merge_fields->LNAME];
                //$names[] = $member->merge_fields->FNAME." ".$member->merge_fields->LNAME;
            }
        
        endfor;
        //$subscribs = $body->members;

        //dd($subscriber);








            return view('subscribers.modals.'.$action,compact('subscriber'))->with('activePage','subscribers');
        }

        
        //return "yes";
    }
}
