<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function get_all_users(){
        $users = User::all();
        return response()->json(
            [
                "data"=>$users
            ]
        );
    }

    public function get_user_who_active(){
       $users = DB::table('users')->select('user_email', 'user_password', 'user_fullname', 'user_role', 'user_status')->where('user_status', 1)->get();
       if(count($users) == 0){
            return response()->json([
                'message'=>[
                    "error"=>true,
                ],
                "data"=> null,
            ], 404);
       }
       return response()->json([
            'message'=>[
                "error"=>false,
            ],
            "data"=> $users,
       ], 200);
    }

    public function create_user(Request $request){
        $user_email = $request->input('user_email');
        $user_password = $request->input("user_password");
        $user_fullname = $request->input("user_fullname");
        $user_role = $request->input("user_role");
        $password_confirmation = $request->input("password_confirmation");

        
        $validation = Validator::make($request->all(),[
            'user_email'=> 'required|string',
            'user_password'=> 'required|string',
            'user_fullname'=> 'required|string',
            'user_role' => 'required|string',
            'password_confirmation'=>'required|string'
        ]);
        if($validation->fails()){
            return response()->json([
                'messages'=>[
                    "user_email"=>$validation->errors()->get("user_email"),
                    "user_password"=>$validation->errors()->get("user_password"),
                    "user_fullname"=>$validation->errors()->get("user_fullname"),
                    "user_role"=>$validation->errors()->get("user_role"),
                    'password_confirmation'=>$validation->errors()->get("password_confirmation")
                ]
            ], 401);
        }

        if($user_password != $password_confirmation){
            return response()->json([
                "messages"=>[
                    "error"=> true,
                    "message"=>"password dan konfirmasi password tidak sama"
                ]
            ], 402);
        }
        $data = [
            "user_email" => $user_email,
            "user_password" => $user_password,
            "user_fullname" => $user_fullname,
            "user_role" => $user_role
        ];
        $user_id = DB::table("users")->insertGetId($data);
        $user = DB::table('users')->where('id', $user_id)->first();
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function update_user(Request $request){
        $user_id = $request->input("id");
        $user_email = $request->input('user_email');
        $user_password = $request->input("user_password");
        $user_fullname = $request->input("user_fullname");
        $user_role = $request->input("user_role");

        $validation = Validator::make($request->all(),[
            'id'=> 'required|integer',
            'user_email'=> 'required|string',
            'user_password'=> 'required|string',
            'user_fullname'=> 'required|string',
            'user_role' => 'required|string',
            'user_status' => 'required|integer'
        ]);

        if($validation->fails()){
            return response()->json([
                'messages'=>[
                    "id"=>$validation->errors()->get("id"),
                    "user_email"=>$validation->errors()->get("user_email"),
                    "user_password"=>$validation->errors()->get("user_password"),
                    "user_fullname"=>$validation->errors()->get("user_fullname"),
                    "user_role"=>$validation->errors()->get("user_role"),
                    "user_status"=>$validation->errors()->get("user_status")
                ]
            ], 401);
        }

        $user = User::findOrFail($user_id);
        $inputedData = [
            "user_email"=>$user_email,
            "user_password"=>$user_password,
            "user_fullname"=>$user_fullname,
            "user_role"=>$user_role
        ];
        if($user != null){
            $user->update($inputedData);
        }
    }

    public function delete_user(Request $request){
        $user = User::findOrFail($request->input("id"));
        if($user != null){
            $user->delete();
            return response()->json([
                "messages"=>[
                    "error"=>false,
                    "message"=>"user bershasil dihapus"
                ],
            ]);
        }
    }
}
