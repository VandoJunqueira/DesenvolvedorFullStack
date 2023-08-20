<?php

namespace App\Console\Commands;

use App\Models\Link;
use App\Models\Metric;
use Illuminate\Console\Command;

class ResetLinkHits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:link-hits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Zera o número de acessos de todos os links';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Zere o número de acessos de todos os links
        Link::query()->update(['hit_counter' => 0]);

        // Exclua todas as métricas de todos os links
        Metric::query()->delete();

        $this->info('Número de acessos de links zerado.');
    }
}
