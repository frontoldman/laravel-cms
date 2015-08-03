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


    /**
     * 通过id获取文章
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }


    public function getAllByUserId($id)
    {
        $posts = Post::with('user')->where('user_id','=',$id)->get();
        return $posts;
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
     * @param $id
     * @param $inputs
     * @return string
     */
    public function update($id,$inputs)
    {
        return '';
    }


    public function delete($id)
    {
        return $this->model->destroy($id);

    }

}