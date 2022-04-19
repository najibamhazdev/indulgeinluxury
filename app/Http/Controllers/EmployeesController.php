<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Country;
use App\Sale;


class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index','show']]);
         $this->middleware('permission:employee-create', ['only' => ['create','store']]);
         $this->middleware('permission:employee-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->with('countries')->paginate(15);
        return view('employees.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5)->with('pageFamily','employees')->with('keywords','');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
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
        $employee = Employee::where('email','=',$email)->first();
        
        if($employee){
            //dd($employee->id);
            return redirect()->route('employees.index')
                        ->with('success','Employee already exist.');
        }

        Employee::create($request->all());


        return redirect()->route('employees.index')
                        ->with('success','Employee created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit',compact('employee'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
         request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);


        $employee->update($request->all());


        return redirect()->route('employees.index')
                        ->with('success','Employee updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {   
        $sales = Sale::where('employee_id',$employee->id)->count();
        //$requests = Clientrequest::where('employee_id',$employee->id)->count();
        $occure = $sales;
        //dd($occure);
        if($occure > 0){
            return redirect()->route('employees.index')
                        ->with('failure','Item related to Other table, Can\'t be deleted');
                        

        }else{
            $employee->delete();
        }


        return redirect()->route('employees.index')
                        ->with('success','Employee deleted successfully');
    }

    public function loadModal($action, $id=null)
    {
       //return view for specified action
       //if action is delete, call this view, etc...
        if($action=='edit'){
            $employee = Employee::find($id);
            $countries = Country::get();
            $jobs = array('Sales','Accountant','Other');
            return view('employees.modals.'.$action,compact('employee','countries','jobs'))->with('activePage','employees');

        }

        if($action=="create"){
            
            $countries = Country::get();
            $jobs = array('Sales','Accountant','Other');
            return view('employees.modals.'.$action)->with('activePage')->with('countries',$countries)->with('jobs',$jobs);
        }

        if($action=="delete"){
            $employee = Employee::find($id);
            return view('employees.modals.'.$action,compact('employee'))->with('activePage','employees');
            //return View::make('users.modals.'.$action)->render()->with('user',$user);

        }

        if($action=="show"){
            $employee = Employee::join("countries","employees.country","=","countries.id")->where("employees.id",$id)->get();
            
            return view('employees.modals.'.$action,compact('employee'))->with('activePage','employees');
        }

        
        
    }
}
