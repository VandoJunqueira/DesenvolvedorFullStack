<?php


namespace App\Repositories;

use App\Models\Metric;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MetricRepository extends Repository
{
    protected $model;

    public function __construct(Metric $model)
    {
        $this->model = $model;
    }


    public function getCountBrowsers()
    {

        $user = auth()->user();

        return $user->links()
            ->join('metrics', 'links.id', '=', 'metrics.link_id')
            ->select('metrics.browsers', DB::raw('COUNT(*) as count'))
            ->whereNull('links.deleted_at')
            ->groupBy('metrics.browsers')
            ->get();
    }

    public function getCountSystens()
    {
        $user = auth()->user();

        return $user->links()
            ->join('metrics', 'links.id', '=', 'metrics.link_id')
            ->select('metrics.system', DB::raw('COUNT(*) as count'))
            ->whereNull('links.deleted_at')
            ->groupBy('metrics.system')
            ->get();
    }

    public function getMetricsChart()
    {
        $user = auth()->user();

        return  $user->links()
            ->join('metrics', 'links.id', '=', 'metrics.link_id')
            ->select(
                DB::raw("DATE_FORMAT(metrics.created_at, '%d-%m') as date"),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy(DB::raw('DATE_FORMAT(metrics.created_at, "%d-%m")'))
            ->get();
    }
}
