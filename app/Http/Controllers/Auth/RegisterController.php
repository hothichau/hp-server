<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $input)
    {
        $user = new User();
        $user->full_name = $input['full_name'];
        $user->phone_number = $this->checkPhone($input['phone_number']);
        $user->email = $this->checkEmail($input['email']);
        $user->avatar = "default.png";
        if (isset($input['avatar'])) {
            $user->avatar = $input['avatar'];
        } else {
            $user->avatar = "default.png";
        }
        $user->password = Hash::make($input['password']);
        $user->save();
        // $this->checkEmail($input);
        return 'Register successfull';

    }
}
