<template>
    <div class="row justify-content-between">
        <CardStats icon="link" count="71" title="Link" class="col-2"></CardStats>
        <CardStats icon="mouse-pointer" count="53" title="Clicks" class="col-2"></CardStats>
        <CardStats class="col-2"></CardStats>
        <CardStats class="col-2"></CardStats>
        <CardStats class="col-2"></CardStats>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
        <MenuLinks active="home" />

        <div>
            <button type="button" class="btn btn-green">
                <div class="d-flex align-items-center">
                    <vue-feather type="arrow-up" size="18"></vue-feather>
                    <vue-feather type="arrow-down" size="18"></vue-feather>
                </div>
            </button>
            <button type="button" class="btn btn-green">
                <div class="d-flex align-items-center">
                    <vue-feather type="sliders" size="20" class="me-2"></vue-feather> <span>Filtros</span>
                </div>
            </button>
        </div>
    </div>


    <div class="mt-5">
        <CardListLInks v-for="link in links" :key="link.id" :link="link" />
    </div>
</template>

<script>

import CardStats from '@/components/cards/CardStats.vue'
import MenuLinks from '@/components/layout/MenuLinks.vue'
import CardListLInks from '@/components/cards/CardListLInks.vue'

export default {
    name: 'DashboardPage',
    components: { CardStats, MenuLinks, CardListLInks },
    data() {
        return {
            active: this.selected || 'home',
            links: [
                {
                    id: 1,
                    lonk_link: 'https://www.esteticaexperts.com.br',
                    title: 'Estética Experts - Cursos Online para Profissionais de Estética',
                    favicon: 'https://www.esteticaexperts.com.br/favicon.ico',
                    slug: 'teste-10000',
                    user_id: 1,
                    hit_counter: null,
                },
                {
                    id: 2,
                    lonk_link: 'https://www.esteticaexperts.com.br',
                    title: 'Estética Experts - Cursos Online para Profissionais de Estética',
                    favicon: 'https://www.esteticaexperts.com.br/favicon.ico',
                    slug: 'rase45322',
                    user_id: 1,
                    hit_counter: 25,
                },
                {
                    id: 3,
                    lonk_link: 'https://www.esteticaexperts.com.br',
                    title: 'Estética Experts - Cursos Online para Profissionais de Estética',
                    favicon: 'https://www.esteticaexperts.com.br/favicon.ico',
                    slug: 'hkcGV9s',
                    user_id: 1,
                    hit_counter: 36,
                },
            ]
        };
    }
}
</script>
