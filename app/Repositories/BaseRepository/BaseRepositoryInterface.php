<?php

namespace App\Repositories\BaseRepository;

interface BaseRepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();
    public function getById($id);
    public function store($data);
    public function destroy($id);
    public function update($data,$id);
}
