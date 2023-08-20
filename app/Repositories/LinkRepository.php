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
        return Link::where('id', $linkId)
            ->where('user_id', $userId)
            ->first();
    }
}
