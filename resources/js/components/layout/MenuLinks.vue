<template>
    <div class="btn-group" role="group" aria-label="Basic example">
        <button v-for="menu in menus" :key="menu.slug" type="button" class="btn btn-green">
            <div class="d-flex align-items-center">
                <vue-feather :type="menu.icon" size="20" class="me-2"></vue-feather> <span v-if="menu.slug == active">
                    {{ menu.title }}
                </span>
            </div>
        </button>
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
                    title: 'Home'
                },
                {
                    slug: 'stats',
                    icon: 'bar-chart',
                    title: 'Estatísticas'
                },
                {
                    slug: 'excluded',
                    icon: 'trash-2',
                    title: 'Excluídos'
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
