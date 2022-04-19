<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emailtemplate;
use App\Producttemplate;
use Corcel\WooCommerce\Model\Product as Corcel;

class EmailtemplateController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:producttemplate-list|producttemplate-create|producttemplate-edit|producttemplate-delete', ['only' => ['index','show']]);
         $this->middleware('permission:producttemplate-create', ['only' => ['create','store']]);
         $this->middleware('permission:producttemplate-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:producttemplate-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emailtemplates = Emailtemplate::latest()->paginate(15);
       
        return view('emailtemplates.index',compact('emailtemplates'))
            ->with('i', (request()->input('page', 1) - 1) * 5)->with('pageFamily','emailtemplate')->with('keywords','');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emailtemplates.create');
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
        
        if($request->hasFile('photo')) {
            //$name = !is_null($filename) ? $filename : Str::random(25);
            $filenameWithExt = $request->file('photo')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('photo')->getClientOriginalExtension();

            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('photo')->storeAs('public/uploads',$fileNameToStore);
            // $file = $request->file('photo')->store('uploads');
            // print_r($request->file('photo')->filename);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        if($request->hasFile('titlephoto')) {
            //$name = !is_null($filename) ? $filename : Str::random(25);
            $filenameWithExt = $request->file('titlephoto')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('titlephoto')->getClientOriginalExtension();

            $fileNameToStore2 = $filename.'_'.time().'.'.$extension;

            $path = $request->file('titlephoto')->storeAs('public/uploads',$fileNameToStore2);
            
        }else{
            $fileNameToStore2="";
        }

        if($request->hasFile('footerphoto')) {
            //$name = !is_null($filename) ? $filename : Str::random(25);
            $filenameWithExt = $request->file('footerphoto')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('footerphoto')->getClientOriginalExtension();

            $fileNameToStore3 = $filename.'_'.time().'.'.$extension;

            $path = $request->file('footerphoto')->storeAs('public/uploads',$fileNameToStore3);
            
        }else{
            $fileNameToStore3="";
        }

        $em_templ = new Emailtemplate;
        $em_templ->name = $request->name;
        $em_templ->headertext = $request->headertext;
        $em_templ->footertext = $request->footertext;
        $em_templ->textafterphoto = $request->textafterphoto;
        $em_templ->color = $request->color;
        $em_templ->photo = $fileNameToStore;
        $em_templ->titlephoto = $fileNameToStore2;
        $em_templ->footerphoto = $fileNameToStore3;
        $em_templ->save();
        
        //Emailtemplate::create($request->all());


        return redirect()->route('emailtemplates.index')
                        ->with('success','Emailtemplate created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Emailtemplate $emailtemplate)
    {
        return view('emailtemplates.show',compact('emailtemplate'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Emailtemplate $emailtemplate)
    {
        return view('emailtemplates.edit',compact('emailtemplate'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emailtemplate $emailtemplate)
    {
         request()->validate([
            'name' => 'required',
            
        ]);

        if($request->hasFile('photo')) {
            //$name = !is_null($filename) ? $filename : Str::random(25);
            $filenameWithExt = $request->file('photo')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('photo')->getClientOriginalExtension();

            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('photo')->storeAs('public/uploads',$fileNameToStore);
            
        }

        if($request->hasFile('titlephoto')) {
            //$name = !is_null($filename) ? $filename : Str::random(25);
            $filenameWithExt = $request->file('titlephoto')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('titlephoto')->getClientOriginalExtension();

            $fileNameToStore2 = $filename.'_'.time().'.'.$extension;

            $path = $request->file('titlephoto')->storeAs('public/uploads',$fileNameToStore2);
            
        }

        if($request->hasFile('footerphoto')) {
            //$name = !is_null($filename) ? $filename : Str::random(25);
            $filenameWithExt = $request->file('footerphoto')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('footerphoto')->getClientOriginalExtension();

            $fileNameToStore3 = $filename.'_'.time().'.'.$extension;

            $path = $request->file('footerphoto')->storeAs('public/uploads',$fileNameToStore3);
            
        }

        $em_templ = $emailtemplate;//Emailtemplate::find($id);
        $em_templ->name = $request->name;
        $em_templ->headertext = $request->headertext;
        $em_templ->footertext = $request->footertext;
        $em_templ->textafterphoto = $request->textafterphoto;
        $em_templ->color = $request->color;
        if($request->hasFile('photo')) {
            $em_templ->photo = $fileNameToStore;
        }
        if($request->hasFile('titlephoto')) {
            $em_templ->titlephoto = $fileNameToStore2;
        }
        if($request->hasFile('footerphoto')) {
            $em_templ->footerphoto = $fileNameToStore3;
        }
        $em_templ->save();



        //$emailtemplate->update($request->all());


        return redirect()->route('emailtemplates.index')
                        ->with('success','Emailtemplate updated successfully');
    }


    public function send(Emailtemplate $emailtemplate, $id)
    {  
        $emailtemplate = Emailtemplate::findOrFail($id);
        
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


        $data =[
            'title'=>'here is the title',
            'content'=>'here is the dynamic content of the email'
        ];

        Mail::send('email_templates.template1', $data, function($message){
            $message->to('najib@lebsiting.com','Najib')->subject('Hello, this is subject');
        });

        
        return $subs;

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emailtemplate $emailtemplate)
    {   
         $products = Producttemplate::where('emailtemplate_id',$emailtemplate->id)->count();
    //    // $requests = Clientrequest::where('category_id',$category->id)->count();
    //     $items = Item::where('category',$category->id)->count();
         $occure = $products ;
        //dd($occure);
       
        if($occure > 0){
            return redirect()->route('emailtemplates.index')
                        ->with('failure','Emailtemplate related to Other table, Can\'t be deleted');
                        

        }else{
            $emailtemplate->delete();
        }


        return redirect()->route('emailtemplates.index')
                        ->with('success','Emailtemplate deleted successfully');
    }


    public function showbrowser($id = null){
        $emailtemplate = Emailtemplate::find($id);
        $producttemplates = Producttemplate::where('emailtemplate_id',$id)->get();
            
           
            return view('email_templates.template1',compact('emailtemplate','producttemplates'))->with('activePage');
    }

    public function loadModal($action, $id=null)
    {
       
        if($action=='edit'){
            $emailtemplate = Emailtemplate::find($id);
            
        
            return view('emailtemplates.modals.'.$action,compact('emailtemplate'))->with('activePage','emailtemplates');

        }

        if($action=="create"){
            
            //$products= Corcel::with('attachment')->get();
            //dd($products);,compact('products')
           
            //return view('email_templates.template1')->with('activePage');
            return view('emailtemplates.modals.'.$action)->with('activePage');
        }

        if($action=="delete"){
            $emailtemplate = Emailtemplate::find($id);
            return view('emailtemplates.modals.'.$action,compact('emailtemplate'))->with('activePage','emailtemplates');
            

        }
        if($action=="send"){
            $emailtemplate = Emailtemplate::find($id);
            return view('emailtemplates.modals.'.$action,compact('emailtemplate'))->with('activePage','emailtemplates');
            
        }

        if($action=="show"){
            
            $emailtemplate = Emailtemplate::find($id);
            $producttemplates = Producttemplate::where('emailtemplate_id',$id)->get();
            //dd($id);
            //$products= Corcel::with('attachment')->get();
            //dd($products);,compact('products')
           
            return view('email_templates.template1',compact('emailtemplate','producttemplates'))->with('activePage');
        }

        
        //return "yes";
    }
}
