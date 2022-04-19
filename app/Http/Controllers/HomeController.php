<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Sale;
use DB;
use App\Item;
use App\Clientrequest;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        $clients_count = Client::count();
        $revenue_today = 0;
        $sales_total = 0;
        $sales = Sale::select('total')->whereDate('created_at', DB::raw('CURDATE()'))->get();
        foreach ($sales as $sale){ 
            $revenue_today += $sale->total;
            }
        $sales_count = Sale::count();
        $total_sales = Sale::all();
        foreach ($total_sales as $total_sale){ 
            $sales_total += $total_sale->total;
            }
        
        $latest_sales = Sale::with('clients')->orderBy('id', 'desc')->take(4)->get();
        
        $latest_clients = Client::latest()->with('countries')->take(4)->get();
        $latest_items = Item::latest()->with('categories')->take(4)->get();
        $latest_requests = Clientrequest::latest()->with('clients')->take(4)->get();
        //dd($latest_requests);
        return view('dashboard')
            ->with('titlePage','Dashboard')
            ->with('pageFamily','')
            ->with('keywords','')
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('clients_count',$clients_count)
            ->with('revenue_today',$revenue_today)
            ->with('sales_count',$sales_count)
            ->with('sales_total',$sales_total)
            ->with('latest_sales',$latest_sales)
            ->with('latest_clients',$latest_clients)
            ->with('latest_items',$latest_items)
            ->with('latest_requests',$latest_requests)
            ;
    }

    public function search(Request $request){
     //   return $request->pageFamily ." ".$request->keywords;
     $keywords = $request->keywords;
     if($request->pageFamily=="users"){
        $data = User::where([ 
            ['name', 'LIKE', '%' . $keywords . '%']
        ])->orderBy('id','DESC')->paginate(15);

        return view('users.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->with('pageFamily','users')->with('keywords',$keywords);
     }
        

        //return "yes";
    }
}
