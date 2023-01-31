<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    

    public function getLast($attributes = [])
    {
        return $this->model->create($attributes);
    }

   
}
