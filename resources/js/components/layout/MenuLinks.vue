<template>
    <div class="btn-group" role="group" aria-label="Basic example">

        <router-link v-for="menu in menus" :key="menu.slug" type="button" class="btn btn-green"
            :class="{ 'active-info text-info': menu.slug == active }" :to="menu.router">
            <div class="d-flex align-items-center">
                <vue-feather :type="menu.icon" size="20"></vue-feather>
                <span v-if="menu.slug == active" class="d-md-inline d-none ms-2">
                    {{ menu.title }}
                </span>
            </div>
        </router-link>
    </div>
</template>


<script>

export default {
    name: 'MenuLinks',
    data() {
        return {
            active: this.selected || 'home',
            menus: [
                {
                    slug: 'home',
                    icon: 'home',
                    title: 'Home',
                    router: '/dashboard'
                },
                {
                    slug: 'stats',
                    icon: 'bar-chart',
                    title: 'Estatísticas',
                    router: '/dashboard/stats'
                },
                {
                    slug: 'excluded',
                    icon: 'trash-2',
                    title: 'Excluídos',
                    router: '/dashboard?deleted=true'
                },
            ]
        };
    },
    watch: {
        selected(newVal) {
            this.active = newVal;
        }
    },
    props: {
        selected: String,
    },
};
</script>

<style>
.active-info {
    border-radius: 10px !important;
    background-color: #f1f1f1;
}
</style>
