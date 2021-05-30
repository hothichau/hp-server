<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /* Get all of user */
    public function index(){
        $users = User::all();
        return $users;
    }

     /* Count number of user */
     public function count(){
        $total_user = DB::table('users')->select(DB::raw('count(*) as quantity'))->get();
        return $total_user;
    }

    /* Search any user */
    function search($key)
    {
        $data = User::where('full_name','like',"%$key")->get();
        return $data;
    }
}

