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
        <MenuLinks :selected="selected" />

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
        {{ filters }}
        <div v-if="(typeof links.data == 'undefined') || page_loading" class="text-center">
            <div class="spinner-border spinner-border text-info" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div v-else>
            <CardListLInks v-for="link in links.data" :key="link.id" :link="link" />

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li v-for="page in links.links" :key="page.label" class="page-item">
                        <a v-if="!isNaN(page.label)" class="page-link rounded rounded-1 m-1" href="#"
                            @click="push(page.label)">
                            {{ page.label }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>

import CardStats from '@/components/cards/CardStats.vue'
import MenuLinks from '@/components/layout/MenuLinks.vue'
import CardListLInks from '@/components/cards/CardListLInks.vue'
import DataProvider from '@/components/DataProvider.vue'

export default {
    name: 'DashboardPage',
    components: { CardStats, MenuLinks, CardListLInks, DataProvider },
    data() {
        return {
            links: {},
            route_api: '/links',
            page_loading: false
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
        push(page) {
            this.$router.push('/dashboard?page=' + page)
        }
    },
    computed: {
        filters() {
            const params = new URLSearchParams(this.$route.query);
            const currentPage = params.get('page') || 1;
            params.set('page', currentPage);

            const query_string = params.toString();
            return '?' + query_string;
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
            this.getLinks()
        },
        '$store.state.actions.delete'(action) {
            this.$utility.deleteById(this.links.data, action.id)
        }
    },
    mounted() {
        console.log(this.$store.state.actions)
        this.getLinks();
    }
}
</script>
