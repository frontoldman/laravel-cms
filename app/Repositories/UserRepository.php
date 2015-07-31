<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{

    /**
     * @var User
     */
    protected $model;


    /**
     * @var 默认roleId
     */
    protected $roleId = 3;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;

    }


    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * 存储用户
     *
     * @param $inputs
     * @param $confirmationCode
     * @return mixed
     */
    public function store($inputs,$confirmationCode)
    {
        $user = new $this->model;
        $user->username = $inputs['username'];
        $user->email = $inputs['email'];
        $user->password = bcrypt($inputs['password']);
        $user->confirm_code = $confirmationCode;
        $user->role_id = $this->roleId;
        $user->save();

        return $user;
    }


    public function confirm($code)
    {
        $user = $this->model->whereConfirmCode($code)->first();
        if($user)
        {
            $user->confirmed = true;
            $user->confirm_code = null;
            $user->save();
        }
        return $user;
    }

    public function getAllByRole($role_id)
    {
        $users = $this->model->with('role')->where('role_id','>=',$role_id)->get();
        return $users;
    }

    /**
     * @param $inputs
     */
    public function update($id,$inputs)
    {

        $user = $this->model->find($id);

        if($user){
            $user->email = $inputs['email'];
            $user->username = $inputs['username'];
            $user->role_id = $inputs['role_id'];
            $user->save();
        }

        return $user;
    }
}