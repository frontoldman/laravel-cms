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
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;

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
        $user->save();

        return $user;
    }


    public function confirm($code)
    {
        //dd($code);

        $user = $this->model->whereConfirmCode($code);

        if($user)
        {
            $user->confirmed = true;
            $user->confirm_code = null;
            $user->save();
        }


        return $user;
    }
}