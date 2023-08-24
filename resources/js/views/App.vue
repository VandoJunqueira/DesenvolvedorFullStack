<template>
    <AppBar />
    <div class="container container-sm" id="container">

        <router-view></router-view>

    </div>
    <FloatingButton class="btn-flex d-md-none" />
</template>


<script>
import AppBar from '@/components/layout/AppBar.vue'
import FloatingButton from '@/components/buttons/FloatingButton.vue'

export default {
    name: 'App',
    components: { AppBar, FloatingButton },
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
