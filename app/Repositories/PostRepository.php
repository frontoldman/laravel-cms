<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends BaseRepository
{

    /**
     * @var $model
     */
    protected $model;


    /**
     * @param $post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;

    }


    public function getById($id)
    {
        return $this->model->find($id);
    }


    /**
     * @param Array $inputs
     * @return static
     */
    public function store($inputs)
    {
        $user = $this->model->create($inputs);

        return $user;
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


    public function delete($id)
    {
        return $this->model->destroy($id);

    }

}