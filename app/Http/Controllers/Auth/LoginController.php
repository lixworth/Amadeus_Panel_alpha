<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    /**
     * @param Response $response
     * @param Request $request
     * @return array
     */
    public function authenticate(Request $request)
    {
        if(Auth::check()){
            return [ "success" => false, "message" => "Already logged in" ];
        }
        if ($this->attemptLogin($request)) {
            return [ "success" => true ];
        }else{
            return [ "success" => false, "message" => "These credentials do not match our records." ];
        }
    }

    public function render()
    {
        if(Auth::check()){
            return redirect('/user');
        }
        return view('login');
    }

    public function username()
    {
        return 'name';
    }
}

