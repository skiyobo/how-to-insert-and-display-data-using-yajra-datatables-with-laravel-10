<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\session;

class HomeController extends Controller
{

    public function index(){
        
        return redirect('login');
     }


    public function Homedashboard(){
        if(Auth::id()){
            $id=Auth::user()->id;
            $email=Auth::user()->email;

                    $title="YouTube Project";

                    return view('user_template.dashboard',compact('title'));
                }else{
                return redirect('login');
            }
    }


    //=======LOGOUT========
    public function logout(){
        session::flush();
        Auth::logout();
       return redirect('login');
    }

}
