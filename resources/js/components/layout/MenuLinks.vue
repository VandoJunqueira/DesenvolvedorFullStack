<template>
    <div class="btn-group" role="group" aria-label="Basic example">

        <router-link v-for="menu in menus" :key="menu.slug" type="button" class="btn btn-green"
            :to="{ name: menu.router }">
            <div class="d-flex align-items-center">
                <vue-feather :type="menu.icon" size="20" class="me-2"></vue-feather> <span v-if="menu.slug == active">
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
                    router: 'dashboard'
                },
                {
                    slug: 'stats',
                    icon: 'bar-chart',
                    title: 'Estatísticas',
                    router: 'dashboard.stats'
                },
                {
                    slug: 'excluded',
                    icon: 'trash-2',
                    title: 'Excluídos',
                    router: 'dashboard.deleted'
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
