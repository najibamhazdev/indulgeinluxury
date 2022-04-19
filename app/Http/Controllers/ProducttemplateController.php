<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Producttemplate;
use App\woocommerce\Product;
use Corcel\WooCommerce\Model\Product as Corcel;
use App\Emailtemplate;


class ProducttemplateController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $producttemplates = Producttemplate::latest()->paginate(15);
       
        return view('producttemplates.index',compact('producttemplates'))
            ->with('i', (request()->input('page', 1) - 1) * 5)->with('pageFamily','producttemplates')->with('keywords','');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('producttemplates.create');
    }


    public function storefromweb(Request $request){

        
        $emailtemplate_id=request('emailtemplate_id');
        $link = request('link');
        $photo = request('photo');
        $name = request('name');
        $product = request('product');
        $postorigin = request('postorigin');
        $productcount = request('productcount');
        $i=0;
        
        foreach($name as $key => $value){
            
            if ($product[$key]==="yes") {
                
                Producttemplate::create([
                    'emailtemplate_id'=>$emailtemplate_id[0],
                    'link'=>$link[$key],
                    'photo'=>$photo[$key],
                    'postorigin'=>$postorigin[$key],
                    'name'=>$value,
                    'posttype'=>'product'
                    
                    ]
                );
            $i++;    
            }
            
        }

        //dd($i);
        return redirect()->route('producttemplates.index')
                        ->with('success','Products created successfully.');
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
       //dd($fileNameToStore);

        $pr_templ = new Producttemplate;
        $pr_templ->name = $request->name;
        $pr_templ->posttype = $request->posttype;
        $pr_templ->link = $request->link;
        $pr_templ->emailtemplate_id = $request->emailtemplate_id;
        $pr_templ->price = $request->price;
        $pr_templ->photo = $fileNameToStore;
        $pr_templ->save();

        return redirect()->route('producttemplates.index')
                        ->with('success','Producttemplate created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Producttemplate $producttemplate)
    {
        return view('producttemplates.show',compact('producttemplate'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Producttemplate $producttemplate)
    {
        return view('producttemplates.edit',compact('producttemplate'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producttemplate $producttemplate)
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
        }


        $producttemplate->name = $request->name;
        $producttemplate->posttype = $request->posttype;
        $producttemplate->link = $request->link;
        $producttemplate->emailtemplate_id = $request->emailtemplate_id;
        $producttemplate->price = $request->price;
        if($request->hasFile('photo')) {
        $producttemplate->photo = $fileNameToStore;
        }
        $producttemplate->save();


        return redirect()->route('producttemplates.index')
                        ->with('success','Producttemplate updated successfully');
    }


    public function send(Producttemplate $producttemplate, $id)
    {  
        $producttemplate = Producttemplate::findOrFail($id);
        
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
    public function destroy(Producttemplate $producttemplate)
    {   
        //$producttemplate = Producttemplate::find($id);
       // $requests = Clientrequest::where('category_id',$category->id)->count();
        //$items = Item::where('category',$category->id)->count();
        //$occure = $producttemplates + $requests + $items;
        //dd($occure);
        $occure=0;
        if($occure > 0){
            return redirect()->route('producttemplates.index')
                        ->with('failure','Producttemplate related to Other table, Can\'t be deleted');
                        

        }else{
            $image_path = "storage/uploads/".$producttemplate->photo;  // Value is not URL but directory file path
            if (file_exists($image_path)) {

                @unlink($image_path);
         
            }
            $producttemplate->delete();
        }


        return redirect()->route('producttemplates.index')
                        ->with('success','Producttemplate deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       
        if($action=='edit'){
            $producttemplate = Producttemplate::find($id);
            $emailtemplates = Emailtemplate::get();
        
            return view('producttemplates.modals.'.$action,compact('producttemplate','emailtemplates'))->with('activePage','producttemplates');

        }

        if($action=="fromwebsite"){
            $emailtemplates = Emailtemplate::get();
            $products= Corcel::with('attachment')->get();
            //dd($products);,compact('products')
           
            //return view('email_templates.template1')->with('activePage');
            return view('producttemplates.modals.'.$action,compact('products','emailtemplates'))->with('activePage');
        }

        if($action=="create"){
            
            //$products= Corcel::with('attachment')->get();
            //dd($products);,compact('products')
            $emailtemplates = Emailtemplate::get();
            
            //return view('email_templates.template1')->with('activePage');
            return view('producttemplates.modals.'.$action,compact('emailtemplates'))->with('activePage');
        }

        if($action=="delete"){
            $producttemplate = Producttemplate::find($id);
            return view('producttemplates.modals.'.$action,compact('producttemplate'))->with('activePage','producttemplates');
            

        }
        if($action=="send"){
            $producttemplate = Producttemplate::find($id);
            return view('producttemplates.modals.'.$action,compact('producttemplate'))->with('activePage','producttemplates');
            
        }

        if($action=="show"){
            
            

            return view('producttemplates.modals.'.$action,compact('producttemplate'))->with('activePage','producttemplates');
        }

        
        //return "yes";
    }
}
