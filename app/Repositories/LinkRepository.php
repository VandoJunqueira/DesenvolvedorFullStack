<?php


namespace App\Repositories;

use App\Models\Link;
use Illuminate\Support\Facades\DB;

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

        if (request('by') && request('type')) {
            $query->orderBy(request('by'), request('type'));
        } else {
            $query->orderBy('created_at', 'DESC');
        }

        if (request('deleted')) {
            $query->onlyTrashed();
        }

        if (request('initial_date')) {
            $query->where('created_at', '>=', request('initial_date') . ' 00:00:00');
        }

        if (request('end_date')) {
            $query->where('created_at', '<=', request('end_date') . ' 23:59:59');
        }

        return $query;
    }

    public function checkSlug($slug)
    {
        return $this->model->where('slug', $slug)->exists();
    }

    public function getCountClicks()
    {
        return $this->model->select(DB::raw('SUM(hit_counter) as total_clicks'))->where('user_id', auth()->user()->id)->first();
    }

    public function countTotal()
    {
        return $this->model->where('user_id', auth()->user()->id)->count();
    }
}
