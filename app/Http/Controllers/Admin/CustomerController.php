<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;

class CustomerController extends Controller
{
     /* Get all of customer from database */
     public function index(){
        $customers = Customer::all();
        foreach($customers as $customer){
         $customer->getUser->id;
         $customer->getService->name;
     }
     return $customers;
    }

    /* Get information for an admin by user_id */
    public function detail($user_id){
        $customer = Customer::where('user_id',$user_id)->get();
        foreach($customer as $cus){
            $customer->getUser->id;
            $customer->getService->name;
        }
        return $customer;
    }

    /* Create an account for customer */
    public function store(Request $input)
    {
        $user = new User();
        $user->full_name = $input['full_name'];
        $user->phone_number = $input['phone_number'];
        $user->email = $input['email'];
        if (isset($input['avatar'])) {
            $user->avatar = $input['avatar'];
        } else {
            $user->avatar = "default.png";
        }
        $user->password = Hash::make($input['password']);
        $user->save();

        $customer = new Customer();

        $customer->user_id = $user->id;
        $customer->age = null;
        $customer->height = null;
        $customer->weight = null;
        $customer->gender = null;
        $customer->service_id = 1;

        $customer->save();

        return $user;
    }

    /* Delete an account of customer */
    public function destroy($user_id)
    {
        $customer = Customer::where('user_id',$user_id);
        $user = User::where('id',$user_id);

        if(!is_null($customer))
        {
            $customer->delete();
        }

        if(!is_null($user))
        {
            $user->delete();
        }
        return response()->json('Successfully Deleted');
    }

    /* Edit information of an admin */
    public function update(Request $input, $user_id)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'phoneNumber' => 'required',
        //     'image' => 'required' //optional if you want this to be required
        // ]);
        $admin = Admin::all();

        if(!is_null($admin)){

            $user =  User::find($user_id);

            // $user->full_name = $input['full_name'];
            // $user->email = $input['email'];
            // $user->password = Hash::make($input['password']);
            // $user->phone_number = $input['phone_number'];

            if(isset($input['full_name'])){
                $user->full_name = $input['full_name'];
            }else{
                $user->full_name = $user->full_name;
            }

            if(isset($input['phone_number'])){
                $user->phone_number = $input['phone_number'];
            }else{
                $user->phone_number = $user->phone_number;
            }

            if(isset($input['email'])){
                $user->email = $input['email'];
            }else{
                $user->email = $user->email;
            }

            if (isset($input['avatar'])) {
                $user->avatar = $input['avatar'];
            } else {
                $user->avatar = $user->avatar;
            }
            if(isset($input['password'])){
                $user->password = Hash::make($input['password']);
            }
            else{
                $user->password =  $user->password;
            }
            $user->save();

            return $user;
        }else{
            return "This account is not existed! Please try again!";
        }
    }


    // function countcustomerervice(){
    //     $count_customer_service = DB::table('services')
    //     ->join('customer', 'services.id', '=', 'customer.service_id')
    //     ->groupBy('services.id','services.name')
    //     ->select(DB::raw('count(customer.account_id) as quantity, services.name as name, services.id as id'))
    //     ->get();
    //     return $count_customer_service;
    // }



    /* Get kind of service which using by each customer */
    public function getCustomerService($id){
        $customer_service = Customer::where('service_id',$id)->get();
        return $customer_service;
    }

    /* Count number of customer */
    public function count(){
        $total_customer = DB::table('customers')->select(DB::raw('count(*) as quantity'))->get();
        return $total_customer;
    }

    /* Get number of customer using each service */
    public function countCustomerService(){
        $count_customer_service = DB::table('services')
        ->join('customers', 'services.id', '=', 'customers.service_id')
        ->groupBy('services.id','services.name')
        ->select(DB::raw('count(customers.user_id) as quantity, services.name as name, services.id as id'))
        ->get();
        return $count_customer_service;
    }

    /* Search any customer */
    public function search(Request $input){
        $customers = Customer::where('name','like',"%$input->text%")->get();
        return $customers;
    }
}
