<?php

namespace App\Http\Controllers;
use App\Models\User;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function index(){

        if( auth()->check() ){
           
            $user=auth()->user();
            $response=[
                'user'=>[
                    'id'=>$user->id,
                    'email'=>$user->email,
                    'role'=>$user->role,
        
                ], 
                'token'=>[
                    'type'=>'Bearer',
                    'value'=>auth()->tokenById($user->id),
                    'expires_at'=>auth()->guard()->factory()->getTTl(),
                    ]
                ];
                return response()->json(['user'=>$response,'error'=>false]);
                }
                return response()->json(['user'=>[],'error'=>true, 'message'=>'Non sei loggato']);
    }

    //
}