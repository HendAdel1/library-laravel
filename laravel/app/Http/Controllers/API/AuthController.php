<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
Use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function create(request $request){
        //authorization
        //validation
        //store in db
        $user =new User();
        $user->email=$request->email;
        $user->name=$request->name;
        $user->password=\Hash::make($request->password);
        $user->role=$request->role;
        $user->save();

       
        // $user->createToken('ios')->plainTextToken;

        return [
            '$user'=>$user,
            'token'=> $user->createToken('ios')->plainTextToken
        ];
        // return $user;

        //return response

    }


    // public function login(request $request){
    //     // $user =new User();
    //    if(\Auth::attempt($request->only('email','password'))); 

    //     return [
    //         '$user'=>\Auth::$user(),
    //         'token'=>\Auth::$user()->createToken('android')->plainTextToken
    //     ];
    // }

    public function login(request $request){
        // $user =new User();
       if(\Auth::attempt($request->only('email','password'))); 
       
        return [
            'user'=>\Auth::user(),
            'token'=>\Auth::user()->createToken('android')->plainTextToken
        ];
    }
}
