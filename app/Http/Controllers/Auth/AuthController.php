<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Models\User;
use Request;
use Crypt;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getRegister()
    {
        return view('user.register');
    }


    public function postRegister(RegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Crypt::encrypt($request->input('password'))
        ]);

        return 'success';
    }


}
