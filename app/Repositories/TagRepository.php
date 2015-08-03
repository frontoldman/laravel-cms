<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends BaseRepository
{

    protected $model;

    /**
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }





}