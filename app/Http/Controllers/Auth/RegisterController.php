<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\Role;
//use http\Env\Request;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function userRegister(Request $request){

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|same:confirm_password|min:8'
        ];
        $this->validate($request,$rules);

        $data = [
            'first_name' => trim($request->first_name),
            'last_name' => trim($request->last_name),
            'email' => trim($request->email),
            'password' => trim(bcrypt($request->password)),
            'role_id' => 11,
            'remember_token' => $request->_token
        ];

        if($user = User::create($data)){

            $auth = [
                'email' => $user->email,
                'password' => $request->password
            ];
            if(Auth::attempt($auth)){
                $role = Role::find(Auth::user()->role_id);
                if($role->title == 'Customer') {
                    return redirect()->route('home');
                }
            }

        }else{
            session()->flash('error','Something error in internal system');
            return redirect()->back();
        }

    }

}
