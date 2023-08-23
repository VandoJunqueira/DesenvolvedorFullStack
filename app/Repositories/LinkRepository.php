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

    public function findLinkByIdAndUser(string $linkId, int $user_id)
    {
        return $this->model->where('id', $linkId)
            ->where('user_id', $user_id)
            ->first();
    }

    public function findLinkBySlugAndUser(string $slug, int $user_id)
    {
        return $this->model->where('slug', $slug)
            ->where('user_id', $user_id)
            ->first();
    }

    public function findLinkBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function filter()
    {
        $query = $this->model->where('user_id', auth()->user()->id);

        if (request('search')) {
            $query->where('title', 'LIKE', '%' . request('search') . '%');
        }

        if (request('deleted')) {
            $query->onlyTrashed();
        }

        return $query->orderBy('created_at', 'DESC');
    }

    public function checkSlug($slug)
    {
        return $this->model->where('slug', $slug)->exists();
    }
}
