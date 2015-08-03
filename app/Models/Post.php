<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

    protected $fillable = ['title','link','summary','content','active','user_id'];

    /**
     *
     * 多对1 关系 多篇文章属于一个用户
     *
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }



}
