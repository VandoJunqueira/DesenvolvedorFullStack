<template>
    <AppBar />
    <div class="container container-sm" id="container">

        <router-view></router-view>

    </div>
</template>


<script>
import AppBar from '@/components/layout/AppBar.vue'

export default {
    name: 'App',
    components: { AppBar },
}
</script>

<style scoped>
#nav-bar-top {
    left: 0;
    right: 0;
}

#container {
    padding-top: 110px;
}
</style>
