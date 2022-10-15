<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use tidy;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTExceptions;


class UserController extends Controller
{


    public function register(Request $request){
        $user= User::where('email',$request['email'])->first();
        if($user){

            $response['status'] = 0;
            $response['message'] ='email already registered';
            $response['code'] =409;

        }else{
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)

        ]);
        $response['status'] = 1;
        $response['message'] ='user registration successful';
        $response['code'] =200;
    }
        return response()->json($response);
    }

    public function login(Request $request){
        $cer=$request->only('email','password');
        try{
            if(!JWTAuth::attempt($cer)){
                $response['data'] =0;
                $response['code'] = 401;
                $response['message'] ='email or password incorrect';
                return response()->json( $response);

            }

        }catch(JWTException $e){
            $response['data'] =null;
            $response['code'] = 1;
            $response['message'] ='could not create token';
            return response()->json( $response);

        }
        $user= auth()->user();
        $data['token']=auth()->claims([
            "user_id"=>$user->id,
            "email"=>$user->email,


        ])->attempt( $cer);

        $response['data'] =$data;
        $response['status'] = 1;
        $response['code'] = 200;
        $response['message'] ='login successfully';
        return response()->json( $response);

    }



}
