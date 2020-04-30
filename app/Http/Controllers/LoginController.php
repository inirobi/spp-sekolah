<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class LoginController extends Controller
{
    public function index(){
        if(!Session::get('login'))
        {
            return view('auth.login');
        }
        else
        {   
            return redirect('home');
        }
    }

    public function loginPost(Request $request){

        $email = $request->email;
        $password = $request->password;

        $data = User::where('email',$email)->first();
        
        if($data){ //apakah username tersebut ada atau tidak
            if(Hash::check($password, $data->password)){
                Session::put('id',$data->id);                
                Session::put('nama',$data->name);
                Session::put('email',$data->email);
                Session::put('login','TRUE');
                return redirect('home')
                    ->with('success', 'Selamat datang '.$data->name);
            }
            else{
                return redirect('login')
                    ->with('warning', 'Password salah')
                    ->withInput();
            }
        }
        else{
            return redirect('login')
                    ->with('warning', 'Email tidak terdaftar')
                    ->withInput();
        }
    }
}
