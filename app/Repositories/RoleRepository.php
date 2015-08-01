<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends BaseRepository
{

    /**
     * @var Role
     */
    protected $model;

    /**
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get()->lists('title', 'id');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getLowsById($id)
    {
        return $this->model->where('id','>=',$id)->get()->lists('title', 'id');
    }




}