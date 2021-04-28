<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\Role;
use Illuminate\Support\Facades\Http;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function loginView(){
        return view('frontend.login.login');
    }

    public function login(Request $request){
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        $this->validate($request, $rules);
        $remember_me = $request->has('remember_me') ? true : false;
        //$remember_me = $request->remember_me;

        $auth = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($auth,$remember_me)){

                return redirect()->route('dashboard');

            }else{
                session()->flash('error','Invalid login or password');
                return redirect()->back();
            }
        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('adminlogin');
    }
    public function userLogout(){
        Auth::logout();
        return redirect()->route('adminlogin');
    }

}
