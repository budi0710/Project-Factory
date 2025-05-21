<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendEmail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request){
        
        $email = $request->email;
        $password = $request->password;
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $users = Users::where('email', $email)->where('password',md5($password))->count();
       
        if ($users){
             session(['admin' => $email]);
            return response()->json(['result'=>true,'message'=>"Email or password is true"]);
        }else{
            return response()->json(['result'=>false,'message'=>"Email or password is incorrect"]);
        }

    }

    public function forgot(Request $request){

        $new_password = Str::random(10);

         $data = [
            'nama' => 'Lamhot Simamora',
            'subject' => 'Send Email By Laravel 12',
            'password' =>  $new_password
        ];

        $email_exist = Users::where('email', $request->email)->count();

        if ($email_exist){
            $email_to = $request->email;

            $email = Users::where('email', $email_to)->first();
            
            $id_email = $email->id;

            $users = Users::find($id_email);

            $users->password = md5($new_password);

            $users->save();

            Mail::to($email_to)->send(new sendEmail($data));

            return  response()->json(['result'=>true,'message'=>'Check your inbox email']);
        }else{
            return response()->json(['result'=>false,'message'=>'Email doesnt exist !']);
        }

    }

     public function register(Request $request){

        $Users = new Users;

        $Users->name = $request->name;
        $Users->email = $request->email;
        $Users->password = md5($request->password);

         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

         $users_exist = Users::where('name', $request->name)->count();

         if ($users_exist)
         {
            return response()->json(['result'=>false,'message'=>"User already exist"]);
         }else{
             if ($Users->save()){
                return response()->json(['result'=>true,'message'=>"Register successfully"]);
            }else{
                return response()->json(['result'=>false,'message'=>"Register failed"]);
            }
         }
       

    }
}
