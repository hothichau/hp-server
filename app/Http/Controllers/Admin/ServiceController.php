<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Customer;

class ServiceController extends Controller
{
    /* Get all of service from database */
    function index(){
        $services = Service::all();
        return $services;
    }

     /* Get a service  */
     function show($id){
        $services = Service::find($id);
        return $services;
    }

    /* Create a new service */
    function store(Request $request)
    {
        // $input->validate([
        //     'name' => 'required',
        //     'price' => 'required',
        //     'description' => 'required',
        // ]);

        $service = Service::create($request->all());

        return $service;
    }

     /* Edit the information of a service */
    function update(Request $input, $id){

        $service = Service::find($id);

        $service->name = $input['name'];
        $service->price = $input['price'];
        $service->description = $input['description'];
        $service->save();

        return $service;
    }

     /* Delete service from database */
    function destroy($id)
    {
        $service = Service::where('id',$id);
        $service_id = Customer::where('service_id',$id);

        if(!is_null($service_id))
        {
            $service_id->delete();
        }
        $service->delete();
        return response()->json('Successfully Deleted');
    }

     /* Search any service */
    function search(Request $input){
        $services = Service::where('name','like',"%$input->text%")->input();
        return $services;
    }

     /* Get information of customer using each service */
    function getCustomer($id){
        $customer_service = Customer::where('service_id',$id)->get();
        foreach($customer_service  as $cus_ser){
            $cus_ser ->getUser->id;
        }
        return $customer_service;
    }

    public function statistiService()
    {
        
        $count_customer_service = DB::table('services')
        ->join('customers', 'services.id', '=', 'customers.service_id')
        ->groupBy('services.id','services.name')
        ->select(DB::raw('count(customers.user_id) as quantity, services.name as name, services.id as id'))
        ->get();
        return json_decode($count_customer_service);
    
    }
}
