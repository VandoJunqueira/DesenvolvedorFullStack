<template>
    <BackButton />

    <div class="card mt-3">
        <div class="card-body ps-5 pe-5">

            <h3 class="mb-4">Duplicar</h3>

            <DataProvider :url="'/links/' + $route.params.slug">
                <template v-slot="{ data }">

                    <FormLink v-if="Object.keys(data).length > 0" :data="data" :copy="true" />

                </template>
            </DataProvider>

        </div>
    </div>
</template>

<script>
import FormLink from '@/views/components/FormLink.vue'
import BackButton from '@/components/buttons/BackButton.vue'
import DataProvider from '@/components/DataProvider.vue'

export default {
    name: 'CopyLinkPage',
    components: { FormLink, BackButton, DataProvider },
}
</script>
