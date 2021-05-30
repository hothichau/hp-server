<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
    protected $avatar;
    /* Get all of admin from database */
    public function index(){
        $admins = Admin::all();
        foreach($admins as $admin){
         $admin->getUser->id;
     }
     return $admins;
    }

    /* Get information for an admin by user_id */
    public function detail($user_id){
        $admin = Admin::where('user_id',$user_id)->get();
        foreach($admin as $ad){
            $ad->getUser->id;
        }
        return $admin;
    }

    /* Create an account for admin */
    public function store(Request $input)
    {
        $user = new User();
        $user->full_name = $input['full_name'];
        $user->phone_number = '';
        $user->email = $input['email'];
        if (isset($input['avatar'])) {
            $user->avatar = $input['avatar'];
        } else {
            $user->avatar = "default.png";
        }
        $user->password = Hash::make($input['password']);
        $user->save();
        $admin = new Admin();
        $admin->user_id = $user->id;
        $admin->save();
        return $user;
    }

     /* Delete an account for admin */
    public function destroy($user_id)
    {
        $admin = Admin::where('user_id',$user_id);
        $user = User::where('id',$user_id);

        if(!is_null($admin))
        {
            $admin->delete();
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
        //     'avatar' => 'required' //optional if you want this to be required
        // ]);
        $admin = Admin::all();
        if(!is_null($admin)){
            $user =  User::find($user_id);
            // $user->full_name = $input['full_name'];
            // $user->email = $input['email'];
            // $user->password = Hash::make($input['password']);
            // $user->phone_number = $input['phone_number'];
            
            // return $user->avatar;
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

            // if(isset($input['avatar'])) {
            //     $user->avatar = $input->file("avatar")->store("public");
            // } else {
            //     $user->avatar = $user->avatar;
            // }
            // if ($input->hasFile('avatar'))
            // {
            //     $file      = $input->file('avatar');
            //     $filename  = $file->getClientOriginalName();
            //     $extension = $file->getClientOriginalExtension();
            //     $picture   = date('His').'-'.$filename;
            //     $file->move(public_path('images'), $picture);
            //     $user->avatar = $picture;        
            // } 
            if($input->file != ''){        
                $path = public_path().'/uploads/images/';
      
                //code for remove old file
                if($user->avatar != ''  && $user->avatar != null){
                     $file_old = $path.$user->avatar;
                     unlink($file_old);
                }
      
                //upload new file
                $file = $input->file;
                $filename = $file->getClientOriginalName();
                $file->move($path, $filename);
      
                //for update in table
                $user->update(['avatar' => $filename]);
                // $user->avatar = $filename;
            }
            else {
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

    /* Search any admin */
    function search($key)
    {
        $data = User::where('full_name','like',"%$key")->get();
        return $data;
    }

     /* Count number of admin */
    function count(){
        $total_admin = DB::table('admins')->select(DB::raw('count(*) as quantity'))->get();
        return $total_admin;
    }

    function logout()
    {
        if (isset($_COOKIE['XSRF-TOKEN'])) {
            unset($_COOKIE['XSRF-TOKEN']);
            setcookie('XSRF-TOKEN', null, -1, '/');
            return "logout succecfull";
        } else {
            return "unknow users";
        }
    }
    
    public function uploadAvatar(Request $request)
    {
      if ($request->hasFile('avatar'))
        {
            $file      = $request->file('avatar');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture   = date('His').'-'.$filename;
            $file->move(public_path('images'), $picture);
            return $this->avatar = $picture;        
        } 
      else
        {
            return response()->json(["message" => "Select avatar first."]);
        }
    }
}
