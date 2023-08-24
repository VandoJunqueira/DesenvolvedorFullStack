<template>
    <router-link type="button" class="btn mb-2 d-flex align-items-center" style="max-width: 140px;" :to="{ name: 'dashboard' }">
        <vue-feather type="chevron-left" size="18" class="text-black-50"></vue-feather> Voltar à lista
    </router-link>
</template>

<script>
export default {
    name: 'BackButton',
}
</script>
