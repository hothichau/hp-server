<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\User;


class LoginController extends Controller
{
    public function login(Request $input)
    {
        $data = [
            'email' => $input->email,
            'password' => $input->password,
        ];
        $check=Auth::attempt($data);

        if ($check) {

            $user = User::where('email', $input->email)->firstOrFail();
            $admin = Admin::where('user_id', '=', $user->id)->exists();

            if ($admin) {
                $token = md5($user->id);
                // create cookie name 'XSRF-TOKEN' with value =$token in on day
                setcookie('XSRF-TOKEN', $token, time() + (86400 * 30), "/");
                // return response()->json([
                //     'access_token' => $token,
                //     'token_type' => 'Bearer',
                //     'id' => $user->id
                // ]);

                return $user;
            }else{
            $data = array(
                'Error' => 'WARNING ACCESS DENIED!(you are not Admin)'
            );
            return response()->json($data, 400);
        }
        }
         else {
            $data = array(
                'Error' => 'Email or password is wrong. Please try again!'
            );
            return response()->json($data, 400);
        }
    }
}

