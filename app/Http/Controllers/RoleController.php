<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
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
     * @return string
     */
    public function getRole()
    {

        $roles = $this->roleRepository->getAllClear();

        return view('admin.role.list',compact('roles'));

    }


    /**
     * @param Request $request
     */
    public function postRole(Request $request)
    {

        $inputs = $request->all();
        $validator = $this->updateValidate($inputs);
        if($validator->fails()){
            $this->throwValidationException($request, $validator);
        }

        $roles = $this->roleRepository->update($request->except('_token'));

        return redirect('/admin/user')->with('ok','更新角色成功');

    }

    private function updateValidate($inputs)
    {
        return Validator::make($inputs, [
            'admin'   => ['required'],
            'opera'   => ['required'],
            'visitor' => ['required']
        ]);
    }

}
