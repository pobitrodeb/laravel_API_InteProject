<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Dotenv\Validator;

use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
   public function register(Request $request){
    $validator = Validator::make($request->all(),[
            'name'              => 'required|string|min:3|max:25',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|password|min:6|confirmed'
        ]);
    if($validator->fails()){
        return response()->json($validator->errors());
    }

    $user =   User::create([
        'name'          => $request->name,
        'email'         => $request->email,
        'password'      => Hash::make($request->password),
    ]);

    return response()->json([
        'message' => 'User Register Create Successfully',
        'user'    =>$user,
    ]);

   }
}
