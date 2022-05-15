<?php

namespace App\Repositories\BaseRepository;

use App\Models\Department;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    function __construct()
    {
        $this->setModel();
    }
    abstract public function getModel();
    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function store($data)
    {
        $this->model->create($data);
    }

    public function update($data, $id)
    {
        return $this->getById($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->getById($id)->delete();
    }
}
