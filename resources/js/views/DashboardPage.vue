<template>
    <DataProvider :url="'/metrics'">
        <template v-slot="{ data }">
            <div v-if="Object.keys(data).length > 0" class="row justify-content-between">
                <CardStats v-for="(stats, index) in data.stats" :key="index" :icon="stats.icon" :count="stats.count"
                    :title="stats.title" class="col-2"></CardStats>

                <CardStats icon="activity" count="21%" title="Avg. CTR" class="col-2"></CardStats>
                <CardStats icon="clock" count="6.37s" title="Avg. Time" class="col-2"></CardStats>
            </div>
        </template>
    </DataProvider>
    <hr>
    <div class="d-flex justify-content-between mt-5">
        <MenuLinks :selected="selected" />

        <div>
            <button type="button" class="btn btn-green">
                <div class="d-flex align-items-center" @click="modal_sort = true">
                    <vue-feather type="arrow-up" size="18"></vue-feather>
                    <vue-feather type="arrow-down" size="18"></vue-feather>
                </div>
            </button>
            <button type="button" class="btn btn-green" @click="modal_filter = true">
                <div class="d-flex align-items-center">
                    <vue-feather type="sliders" size="20" class="me-2"></vue-feather> <span>Filtrar</span>
                </div>
            </button>
            <button type="button" class="btn btn-green" v-if="has_filter" @click="clearFilter">
                <div class="d-flex align-items-center">
                    <vue-feather type="x-square" size="16" class="me-2"></vue-feather> <span>Limpar</span>
                </div>
            </button>
        </div>
    </div>

    <div class="mt-5">

        <div v-if="(typeof links.data == 'undefined') || page_loading" class="text-center">
            <div class="spinner-border spinner-border text-info" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div v-else>
            <CardListLInks v-for="link in links.data" :key="link.id" :link="link" />

            <div v-if="links.total == 0" class="alert alert-info text-center">
                Nenhum link encontrado!
            </div>

            <nav v-if="links.total > 0 && links.last_page > 1" aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li v-for=" page  in  links.links " :key="page.label" class="page-item">
                        <a v-if="!isNaN(page.label)" class="page-link rounded rounded-1 m-1" href="#"
                            @click="pushPage(page.label)">
                            {{ page.label }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <Modal :title="'Classificar'" :visible="modal_sort" @setVisible="modal_sort = false">
        <template v-slot:body>
            <div class="row">

                <div class="col-md-6 col-12">
                    <select v-model="order.by" class="form-select form-select-lg">
                        <option value="created_at">Data de Criação</option>
                        <option value="updated_at">Data de Atualização</option>
                        <option value="hit_counter">Clicks</option>
                        <option value="title">Título</option>
                    </select>
                </div>
                <div class="col-md-6 col-12">
                    <select v-model="order.type" class="form-select form-select-lg">
                        <option value="ASC">Crescente</option>
                        <option value="DESC">Decrescente</option>
                    </select>
                </div>

            </div>
        </template>
        <template v-slot:footer>
            <div class="text-center">
                <button class="btn btn-lg btn-primary" @click="handleOrder">
                    Classificar
                </button>
            </div>
        </template>
    </Modal>

    <Modal :title="'Filtrar'" :visible="modal_filter" @setVisible="modal_filter = false">
        <template v-slot:body>

            <form action="#" id="form_filter" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <input v-model="filter.initial_date" class="form-control form-control-lg" type="date" required>
                    </div>
                    <div class="col-md-6 col-12">
                        <input v-model="filter.end_date" class="form-control form-control-lg" type="date" required>
                    </div>
                </div>
            </form>

        </template>
        <template v-slot:footer>
            <div class="text-center">
                <button class="btn btn-lg btn-primary" @click.prevent="handleFilter">
                    Filtrar
                </button>
            </div>
        </template>
    </Modal>
</template>

<script>

import CardStats from '@/components/cards/CardStats.vue'
import MenuLinks from '@/components/layout/MenuLinks.vue'
import CardListLInks from '@/components/cards/CardListLInks.vue'
import DataProvider from '@/components/DataProvider.vue'
import Modal from "@/components/modal/Modal.vue";

export default {
    name: 'DashboardPage',
    components: { CardStats, MenuLinks, CardListLInks, DataProvider, Modal },
    data() {
        return {
            links: {},
            route_api: '/links',
            page_loading: false,
            modal_sort: false,
            modal_filter: false,
            params: null,
            query_string: null,
            has_filter: false,
            order: {
                by: 'created_at',
                type: 'DESC',
            },
            filter: {
                initial_date: '',
                end_date: '',
            }
        };
    },
    methods: {
        async getLinks() {
            this.page_loading = true;
            this.$http.get(this.route_api + this.filters).then((response) => {
                this.links = response.data || {};
                this.page_loading = false;
            });
        },
        pushPage(page) {
            this.params.set('page', page);
            this.push();
            // this.$router.push('/dashboard?page=' + page)
        },
        push() {
            this.query_string = this.params.toString();
            this.$router.push('/dashboard?' + this.query_string)
        },
        handleOrder() {
            this.has_filter = true
            this.params.set('by', this.order.by);
            this.params.set('type', this.order.type);
            this.push();
            this.modal_sort = false;
        },
        handleFilter() {
            if (this.$utility.validar('form_filter')) {
                this.has_filter = true
                this.params.set('initial_date', this.filter.initial_date);
                this.params.set('end_date', this.filter.end_date);
                this.push();
                this.modal_filter = false;
            }
        },
        clearFilter() {
            this.has_filter = false
            this.params.delete('by');
            this.params.delete('type');
            this.params.delete('search');
            this.params.delete('end_date');
            this.params.delete('initial_date');
            this.push();
        }
    },
    computed: {
        filters() {
            if (this.params != null) {

                const currentPage = this.params.get('page') || 1;
                this.params.set('page', currentPage);

                const search = this.params.get('search') || null;
                if (search != null) {
                    this.has_filter = true
                    this.params.set('search', search);
                }

                const deleted = this.params.get('deleted') || null;
                if (deleted != null) {
                    this.params.set('deleted', deleted);
                }

                this.query_string = this.params.toString();
                return '?' + this.query_string;
            }
            return '';
        },
        selected() {
            if (typeof this.$route.query.deleted != 'undefined') {
                return 'excluded';
            }
            return 'home';
        }
    },
    watch: {
        '$route.query'() {
            this.params = new URLSearchParams(this.$route.query);
            this.getLinks()
        },
        '$store.state.actions.delete'(action) {
            this.$utility.deleteById(this.links.data, action.id)
        }
    },
    mounted() {
        this.params = new URLSearchParams(this.$route.query);
        this.getLinks();
    }
}
</script>
