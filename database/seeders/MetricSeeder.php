<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;
use App\Models\Metric;

class MetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Metric::factory()->count(20)->create();

        $links = Link::all();
        foreach ($links as $link) {
            $metric_count = Metric::where('link_id', $link->id)->count();
            $link->update(['hit_counter' => $metric_count]);
        }
    }
}
