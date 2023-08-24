<?php

namespace App\Services;

use App\Repositories\LinkRepository;
use App\Repositories\MetricRepository;

class MetricServices
{
    private $repository;
    private $linkRepository;

    public function __construct(MetricRepository $repository, LinkRepository $linkRepository)
    {
        $this->repository = $repository;
        $this->linkRepository = $linkRepository;
    }


    public function getMetrics()
    {
        return [
            'stats' => [
                ['title' => 'Links', 'count' => $this->linkRepository->countTotal(), 'icon' => 'link', 'icon' => 'mouse-pointer'],
                ['title' => 'Views', 'count' => $this->linkRepository->getCountClicks()->total_clicks ?? 0, 'icon' => 'link', 'icon' => 'eye'],
                ['title' => 'Clicks', 'count' =>  $this->linkRepository->getCountClicks()->total_clicks ?? 0, 'icon' => 'link'],
            ],
            'metrics' => [
                'browsers' => $this->repository->getCountBrowsers(),
                'systems' => $this->repository->getCountSystens(),
            ],
            'graphic' => $this->repository->getMetricsChart()
        ];
    }
}
