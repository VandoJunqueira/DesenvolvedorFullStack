<template>
    <BackButton />

    <DataProvider :url="'/links/' + $route.params.slug">
        <template v-slot="{ data }">

            <CardListLInks v-if="Object.keys(data).length > 0" :link="data" :details="true" />

        </template>
    </DataProvider>
</template>


<script>

import DataProvider from '@/components/DataProvider.vue'
import Avatar from '@/components/Avatar.vue';
import CardListLInks from '@/components/cards/CardListLInks.vue'
import BackButton from '@/components/buttons/BackButton.vue'

export default {
    name: 'DetailsLinkPage',
    components: { DataProvider, Avatar, CardListLInks, BackButton },

}
</script>
