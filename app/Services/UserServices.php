<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserServices
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    public function store(array $data)
    {
        return $this->repository->store($data);
    }
}
