<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Tag;

class PostRepository extends BaseRepository
{

    /**
     * @var $model
     */
    protected $model;


    /**
     * @param Post $post
     * @param Tag $tag
     */
    public function __construct(Post $post,Tag $tag)
    {
        $this->model = $post;
        $this->tag = $tag;
    }


    /**
     * 通过id获取文章
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        $post = $this->model->with('tags')->find($id);

        $tags = [];

        foreach($post->tags as $tag) {
            array_push($tags, $tag->tag);
        }

        return [
            'post' => $post,
            'tags'  => $tags
        ];
    }


    public function getAll()
    {
        $posts = $this->model->with('user')->where('active','=',true)->get();

        return $posts;
    }

    /**
     * 根据userId 获取post
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
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
        $post = $this->model->create($inputs);

        $tags = explode(',',$inputs['tags']);
        $count = count($tags);
        if($count){
            foreach($tags as $key => $value){
                $tag = $this->tag->whereTag($value)->first();
                if(is_null($tag)){
                    $tag = new $this->tag;
                    $tag->tag = $value;
                    $tag->save();
                    $post->tags()->save($tag);
                }else{
                    $post->tags()->attach($tag->id);
                }
            }
        }

        return $post;
    }

    /**
     * @param $id
     * @param $inputs
     * @return string
     */
    public function update($id,$inputs)
    {
        $post = $this->model->find($id);

        $post->update($inputs);

        $tag_ids = [];

        if(isset($inputs['tags'])){
            $tags = explode(',',$inputs['tags']);
            foreach($tags as $key => $value){
                $tag = $this->tag->whereTag($value)->first();
                if(is_null($tag)){
                    $tag = new $this->tag;
                    $tag->tag = $value;
                    $tag->save();
                }
                array_push($tag_ids,$tag->id);
            }
        }



        $post->tags()->sync($tag_ids);

        return $post;
    }


    public function delete($id)
    {
        $model = $this->model->find($id);

        $model->tags()->detach();

        $model->delete();

        return $model;

    }

}