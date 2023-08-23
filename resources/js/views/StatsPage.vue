<template>
    <div class="row justify-content-between">
        <CardStats icon="link" count="71" title="Link" class="col-2"></CardStats>
        <CardStats icon="mouse-pointer" count="53" title="Clicks" class="col-2"></CardStats>
        <CardStats class="col-2"></CardStats>
        <CardStats class="col-2"></CardStats>
        <CardStats class="col-2"></CardStats>
    </div>
    <hr>
    <div class="d-flex justify-content-between mt-5">
        <MenuLinks selected="stats" />
    </div>

    <div class="mt-5">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <LineChart />
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card overflow-hidden">
                    <div class="card-header bg-white">
                        Principais Navegadores
                    </div>
                    <div class="card-body p-2">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-light">
                                <div class="row">
                                    <div class="col-8 fw-bold">Navegador</div>
                                    <div class="col-4 fw-bold text-center">Cliques</div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-8">Chrome</div>
                                    <div class="col-4 text-center">86</div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-8">Firefox</div>
                                    <div class="col-4 text-center">45</div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-8">Safari</div>
                                    <div class="col-4 text-center">3</div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-8">Chrome Mobile</div>
                                    <div class="col-4 text-center">2</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card overflow-hidden">
                    <div class="card-header bg-white">
                        Principais Navegadores
                    </div>
                    <div class="card-body p-2">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-light">
                                <div class="row">
                                    <div class="col-8 fw-bold">Navegador</div>
                                    <div class="col-4 fw-bold text-center">Cliques</div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-8">Chrome</div>
                                    <div class="col-4 text-center">86</div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-8">Firefox</div>
                                    <div class="col-4 text-center">45</div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-8">Safari</div>
                                    <div class="col-4 text-center">3</div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-8">Chrome Mobile</div>
                                    <div class="col-4 text-center">2</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import CardStats from '@/components/cards/CardStats.vue'
import MenuLinks from '@/components/layout/MenuLinks.vue'
import LineChart from '@/components/charts/LineChart.vue'

export default {
    name: 'StatsPage',
    components: { CardStats, MenuLinks, LineChart },
}
</script>
