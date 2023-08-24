<template>
    <DataProvider :url="'/metrics'">
        <template v-slot="{ data }">
            <div v-if="Object.keys(data).length > 0">

                <div class="row justify-content-between">
                    <CardStats v-for="(stats, index) in data.stats" :key="index" :icon="stats.icon" :count="stats.count"
                        :title="stats.title" class="col-2"></CardStats>

                    <CardStats icon="activity" count="21%" title="Avg. CTR" class="col-2"></CardStats>
                    <CardStats icon="clock" count="6.37s" title="Avg. Time" class="col-2"></CardStats>
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
                                    <LineChart  :data="data.graphic"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card overflow-hidden">
                                <div class="card-header bg-white fw-bold">
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
                                        <li v-for="(browser, index) in data.metrics.browsers" :key="index"
                                            class="list-group-item list-group-item-action">
                                            <div class="row">
                                                <div class="col-8">{{ browser.browsers }}</div>
                                                <div class="col-4 text-center">{{ browser.count }}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card overflow-hidden">
                                <div class="card-header bg-white fw-bold">
                                    Principais Sistemas Operacionais
                                </div>
                                <div class="card-body p-2">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-light">
                                            <div class="row">
                                                <div class="col-8 fw-bold">Sitema Operacional</div>
                                                <div class="col-4 fw-bold text-center">Cliques</div>
                                            </div>
                                        </li>
                                        <li v-for="(system, index) in data.metrics.systems" :key="index"
                                            class="list-group-item list-group-item-action">
                                            <div class="row">
                                                <div class="col-8">{{ system.system }}</div>
                                                <div class="col-4 text-center">{{ system.count }}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </template>
    </DataProvider>
</template>

<script>

import CardStats from '@/components/cards/CardStats.vue'
import MenuLinks from '@/components/layout/MenuLinks.vue'
import LineChart from '@/components/charts/LineChart.vue'
import DataProvider from '@/components/DataProvider.vue'

export default {
    name: 'StatsPage',
    components: { CardStats, MenuLinks, LineChart, DataProvider },
}
</script>
