<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Saleitem;
use Validator;

class Saleitems extends Controller
{
    function index()
    {
     return view('dynamic_field');
    }

    function insert(Request $request)
    {
     if($request->ajax())
     {
      $rules = array(
       'item_id.*'  => 'required',
       'sale_id.*'  => 'required',
       'employee_id.*'  => 'required',
       'empl_commision.*'  => 'required',
       'price.*'  => 'required'
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
      }

      $sale_id = $request->sale_id;
      $employee_id = $request->employee_id;
      $expences = $request->expences;
      $price = $request->price;
      $empl_commision = $request->empl_commision;
      $item_id = $request->item_id;
      

      for($count = 0; $count < count($sale_id); $count++)
      {
       $data = array(
        'sale_id' => $sale_id[$count],
        'employee_id' => $employee_id[$count],
        'expences' => $expences[$count],
        'price' => $price[$count],
        'empl_commision' => $empl_commision[$count]
        
       );
       $insert_data[] = $data; 
      }

      DynamicField::insert($insert_data);
      return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
     }
    }



}
