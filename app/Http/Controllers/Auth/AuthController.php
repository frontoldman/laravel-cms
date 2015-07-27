<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Crypt;
use App\Jobs\sendMail;
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

    protected $redirectAfterLogout = '/home';

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->userRepository = $userRepository;
    }

    /**
     *
     * validate register
     *
     */
    public function registerValidator($inputs)
    {
        return Validator::make(
            $inputs,
            [
                'email'            => ['required', 'email'],
                'username'         => ['required','min:8'],
                'password'         => ['required',['confirmed']]
            ]
        );
    }

    /**
     * 注册新用户
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister(Request $request)
    {

        $validator = $this->registerValidator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $inputs = $request->all();
        $confirmationCode = str_random(30);

        $user = $this->userRepository->store($inputs,$confirmationCode);

        $this->dispatch(new SendMail($user));

       // Auth::login($this->create($request->all()));

        return redirect($this->redirectPath());
    }

    /**
     *  验证新用户
     *
     *
     */
    public function getConfirm($code)
    {

        $user = $this->userRepository->confirm($code);

        if($user){
            return redirect('/auth/login')->with('error', '认证成功');
        }else{
            return '认证失败';
        }

    }


    public function loginValidator($inputs)
    {
        return Validator::make(
            $inputs,
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );
    }

    /**
     * @param Request $request
     * @param Guard $auth
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public  function postLogin(Request $request,Guard $auth)
    {

        $validator = $this->loginValidator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if(!$auth->validate($credentials)){
            return redirect('/auth/login')
                ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                ])
                ->withInput($request->only('email'));
        }

        $user = $auth->getLastAttempted();



        if($user->confirmed) {
            $auth->login($user, $request->has('memory'));

            if($request->session()->has('user_id'))	{
                $request->session()->forget('user_id');
            }

            return redirect('/home');
        }

        $request->session()->put('user_id', $user->id);

        return redirect('/auth/login')->with('error', '请重新验证');

    }


    /**
     * @return string
     */
    public function getFailedLoginMessage(){
        return '用户名或者密码错误！';
    }

}
