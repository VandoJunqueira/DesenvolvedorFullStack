<?php


namespace App\Repositories;

use App\Models\Link;

class LinkRepository extends Repository
{
    protected $model;

    public function __construct(Link $model)
    {
        $this->model = $model;
    }

    public function findLinkByIdAndUser(string $linkId, int $userId)
    {
        return $this->model->where('id', $linkId)
            ->where('user_id', $userId)
            ->first();
    }

    public function findLinkBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
