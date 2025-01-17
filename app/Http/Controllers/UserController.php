<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function loginUser(Request $request){
        $user_email = $request->input('user_email');
        $user_password =$request->input("user_password");
        $validation = Validator::make($request->all(),[
            'user_email'=> 'required|string',
            'user_password'=> 'required|string'
        ]);
        if($validation->fails()){
            return response()->json([
                'messages'=>[
                    "user_email"=>$validation->errors()->get("user_email"),
                    "user_password"=>$validation->errors()->get("user_password")
                ]
            ], 401);
        }



        if(User::where(['user_email'=>$user_email, 'user_password'=>$user_password])->first()){
            return response()->json([
                "messages"=> [
                    "user_email"=> "Benar",
                    "user_password"=>"Benar"
                ],
                "user_data"=> User::where(['user_email' => $user_email, 'user_password' => $user_password])->first(),
            ], 200);
        }

        if(!(User::where(['user_email'=>$user_email, 'user_password'=>$user_password])->first())){
            return response()->json([
                'messages'=> [
                    "email_password"=>"Email atau password salah"
                ]
            ], 401);
        }

    }

    public function get_user_by_id(Request $request){
        $id = $request->id;
        $user = User::find(intval($id));
        return response()->json([
            "messages"=>[
                "error"=> false,
            ],
            "data" => $user
        ], 200);
    }

    public function get_user_who_active(){
        foreach(User::where("","")->cursor() as $user){
            
        }
    }
}
