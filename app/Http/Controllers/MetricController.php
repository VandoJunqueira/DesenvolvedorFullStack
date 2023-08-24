<?php

namespace App\Http\Controllers;

use App\Services\LinkServices;
use App\Services\MetricServices;
use Illuminate\Http\Request;

class MetricController extends Controller
{

    public MetricServices $metricServices;
    public LinkServices $linkServices;

    public function __construct(MetricServices $metricServices, LinkServices $linkServices)
    {
        $this->metricServices = $metricServices;
    }

    public function metrics()
    {

        $metrics = $this->metricServices->getMetrics();

        return response()->json($metrics);
    }
}
