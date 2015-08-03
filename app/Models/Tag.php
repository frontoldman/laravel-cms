<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'Tags';


    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

}
