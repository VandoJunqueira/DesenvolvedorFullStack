<template>
    <div v-if="this.$store.state.auth.user">
        <MenuLinks class="mt-2" selected="none" />
    </div>

    <div class="card mt-3">
        <div class="card-body ps-md-5 pe-md-5">

            <h3 class="mb-4">Encurtar um link longo</h3>

            <FormLink :hide="true" />
        </div>
    </div>
</template>

<script>
import FormLink from '@/views/components/FormLink.vue'
import MenuLinks from '@/components/layout/MenuLinks.vue'

export default {
    name: 'HomePage',
    components: { FormLink, MenuLinks },
}
</script>
