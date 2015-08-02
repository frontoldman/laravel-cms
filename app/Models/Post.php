<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $table = 'posts';

    protected $fillable = ['title','link','summary','content','active','user_id'];


}
