<template>
    <div class="card mb-3">
        <div class="card-body pt-4 pb-4">

            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <div>
                        <div class="dropdown mt-1">
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <vue-feather type="more-vertical" size="25" class="text-black-50"></vue-feather>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div>
                            <Avatar :src="link.favicon" class="me-3 mt-1 border border-2 p-1" size="avatar-2xl" />
                        </div>
                        <div>
                            <h5>{{ link.title }}</h5>
                            <div>
                                <a class="link-info text-decoration-none" target="_black" :href="$app_url + link.slug">
                                    {{ $app_url + link.slug }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="ps-3 pe-3">
                        <button class="btn">
                            <div class="stats-link">
                                18 <vue-feather type="bar-chart-2" size="16"
                                    class="text-black-50 ms-1"></vue-feather><vue-feather type="bar-chart" size="16"
                                    class="text-black-50 bar-chart"></vue-feather>
                            </div>
                        </button>
                    </div>
                    <div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn">
                                <vue-feather type="copy" size="18" class="text-black-50"></vue-feather>
                            </button>
                            <button type="button" class="btn">
                                <vue-feather type="edit" size="18" class="text-black-50"></vue-feather>
                            </button>



                            <button v-if="link.hit_counter == null" type="button" class="btn">
                                <vue-feather type="trash" size="18" class="text-danger"></vue-feather>
                            </button>

                            <Tooltip v-else :title="'Links redirecionados não podem ser excluídos'">
                                <button type="button" class="btn cursor-not-allowed">
                                    <vue-feather type="trash" size="18" class="text-muted"></vue-feather>
                                </button>
                            </Tooltip>
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

export default {
    name: 'CardListLInks',
    components: { Avatar, Tooltip },
    props: {
        link: Object,
    },
};
</script>

<style scoped>
.stats-link {
    display: flex;
    font-size: 12px;
}

.bar-chart {
    margin-left: -4px;
}
</style>
