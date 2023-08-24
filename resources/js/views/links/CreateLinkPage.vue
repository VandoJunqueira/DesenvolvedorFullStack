<template>
    <BackButton />

    <div class="card mt-3">
        <div class="card-body ps-md-5 pe-md-5">

            <h3 class="mb-4">Criar novo</h3>

            <FormLink />
        </div>
    </div>
</template>

<script>
import FormLink from '@/views/components/FormLink.vue'
import BackButton from '@/components/buttons/BackButton.vue'

export default {
    name: 'CreateLinkPage',
    components: { FormLink, BackButton },
}
</script>
