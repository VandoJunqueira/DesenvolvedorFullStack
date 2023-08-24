<template>
    <div class="card mb-3">
        <div class="card-body pt-4 pb-4">

            <div class="d-flex justify-content-between" :class="{ 'align-items-center': !details }">

                <div class="d-flex">
                    <div>
                        <div class="dropdown mt-1">
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <vue-feather type="more-vertical" size="25" class="text-black-50"></vue-feather>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <router-link type="button" class="dropdown-item"
                                        :to="{ name: 'dashboard.details', params: { slug: link.slug } }">
                                        <vue-feather type="link-2" size="16" class="text-black-50"></vue-feather> Detalhes
                                    </router-link>
                                </li>
                                <li>
                                    <router-link type="button" class="dropdown-item"
                                        :to="{ name: 'dashboard.copy', params: { slug: link.slug } }">
                                        <vue-feather type="copy" size="16" class="text-black-50"></vue-feather> Copiar
                                    </router-link>
                                </li>
                                <li>
                                    <router-link type="button" class="dropdown-item"
                                        :to="{ name: 'dashboard.edit', params: { slug: link.slug } }">
                                        <vue-feather type="edit" size="16" class="text-black-50"></vue-feather> Editar
                                    </router-link>
                                </li>
                                <li>
                                    <a href="#" @click.prevent="destroy(link.id)" type="button"
                                        class="dropdown-item text-danger">
                                        <vue-feather type="trash" size="16" class="text-danger"></vue-feather> Excluir
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <h3 v-if="details" class="mb-3">{{ link.title }}</h3>
                        <div class="d-flex">
                            <div>
                                <Avatar :src="link.favicon" class="me-3 mt-1 border border-2" size="avatar-2xl" />
                            </div>
                            <div>
                                <router-link v-if="!details" type="button" class="h5 text-decoration-none"
                                    :to="{ name: 'dashboard.details', params: { slug: link.slug } }">
                                    {{ link.title }}
                                </router-link>
                                <div>
                                    <div>
                                        <a class="link-info text-decoration-none" target="_black"
                                            :href="$app_url + link.slug">
                                            {{ $app_url + link.slug }}
                                        </a>
                                    </div>

                                    <div v-if="details">
                                        <a class="link-info text-decoration-none text-dark small mt-1 text-break" target="_black"
                                            :href="$app_url + link.slug">
                                            {{ link.long_link }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="details">


                            <div class="mt-5 d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <vue-feather type="calendar" size="20" class="text-black-50 me-2"></vue-feather>
                                    {{ $utility.date(link.created_at, 'D MMMM YYYY - HH:mm') }}
                                </div>
                                <div class="stats-link details ms-3">
                                    <vue-feather type="bar-chart-2" size="20" class="text-black-50 ms-1"></vue-feather>
                                    <vue-feather type="bar-chart" size="20" class="text-black-50 bar-chart"></vue-feather>
                                    {{ link.hit_counter || 0 }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-md-flex d-none">
                    <div v-if="!details" class="ps-3 pe-3">
                        <button class="btn">
                            <div class="stats-link">
                                {{ link.hit_counter || 0 }} <vue-feather type="bar-chart-2" size="16"
                                    class="text-black-50 ms-1"></vue-feather><vue-feather type="bar-chart" size="16"
                                    class="text-black-50 bar-chart"></vue-feather>
                            </div>
                        </button>
                    </div>
                    <div>
                        <div v-if="!this.$route.query.deleted" class="btn-group" role="group" aria-label="Botões de Ações">
                            <router-link type="button" class="btn"
                                :to="{ name: 'dashboard.copy', params: { slug: link.slug } }">
                                <vue-feather type="copy" size="18" class="text-black-50"></vue-feather>
                            </router-link>

                            <router-link type="button" class="btn"
                                :to="{ name: 'dashboard.edit', params: { slug: link.slug } }">
                                <vue-feather type="edit" size="18" class="text-black-50"></vue-feather>
                            </router-link>

                            <button type="button" class="btn" @click="destroy(link.id)">
                                <vue-feather type="trash" size="18" class="text-black-50"></vue-feather>
                            </button>

                        </div>

                        <div v-else class="btn-group" role="group" aria-label="Botões de Ações">
                            <button type="button" class="btn" @click="destroy(link.id)">
                                <vue-feather type="refresh-ccw" size="18" class="text-black-50"></vue-feather>
                            </button>

                            <button type="button" class="btn" @click="destroy(link.id)">
                                <vue-feather type="trash" size="18" class="text-black-50"></vue-feather>
                            </button>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>


<script>

import Avatar from '@/components/Avatar.vue';
import Tooltip from '@/components/tooltip/Tooltip.vue'
import swal from '@/utility/swal';

export default {
    name: 'CardListLInks',
    components: { Avatar, Tooltip },
    mixins: [swal],
    props: {
        link: Object,
        details: {
            type: Boolean,
            default: false
        },
    },
    methods: {
        destroy(id) {
            this.showDeleteConfirmation('/links/' + id, { id: id });
        }
    },
};
</script>

<style scoped>
.stats-link {
    display: flex;
    font-size: 12px;
}

.stats-link.details {
    font-size: 16px;
}

.bar-chart {
    margin-left: -4px;
}
</style>
