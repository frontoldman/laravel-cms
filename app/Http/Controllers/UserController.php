<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use App\Jobs\sendMail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     * @param Guard $auth
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        Guard $auth)
    {
        $this->middleware('admin');
        $this->auth = $auth;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->userRepository->getAllByRole($this->auth->user()->role_id);

        return view('admin.user.list',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $roles = $this->roleRepository->getLowsById($this->auth->user()->id);

        return view('admin.user.create',compact('roles'));

    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {

        $inputs = $request->all();
        $validator = $this->addValidate($inputs);
        if($validator->fails()){
            $this->throwValidationException($request, $validator);
        }

        $inputs = $request->all();

        $user = $this->userRepository->store($inputs);

        $this->dispatch(new SendMail($user));

        // Auth::login($this->create($request->all()));

        if($user){
            return redirect('/admin/user')->with('ok','添加成功');
        }else{
            return redirect()->to($this->getRedirectUrl())
                ->withInput($request->input())
                ->withErrors([
                    'message' => '添加失败'
                ]);
        }

    }

    /**
     * @param $inputs
     * @return mixed
     */
    private function addValidate($inputs)
    {
        return Validator::make($inputs, [
            'email'            => ['required', 'email'],
            'username'         => ['required','min:8'],
            'password'         => ['required',['confirmed']]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        $roles = $this->roleRepository->getLowsById($this->auth->user()->id);
        return view('admin.user.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return Response
     */
    public function update($id,Request $request)
    {
        $inputs = $request->all();
        $validator = $this->updateValidate($inputs);
        if($validator->fails()){
            $this->throwValidationException($request, $validator);
        }

        $user = $this->userRepository->update($id,$inputs);

        if($user){
            return redirect('/admin/user')->with('ok','更新成功');
        }else{
            return redirect()->to($this->getRedirectUrl())
                            ->withErrors([
                            'message' => '更新失败'
                        ]);
        }

    }

    public function updateValidate($inputs)
    {

        return Validator::make($inputs,[
            'email' => 'required|email',
            'username' => 'required'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
