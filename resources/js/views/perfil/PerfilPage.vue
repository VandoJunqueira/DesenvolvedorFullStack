<template>
    <DataProvider :url="'/perfil'">
        <template v-slot="{ data }">
            <div v-if="Object.keys(data).length > 0" class="row justify-content-center mt-3">
                <div class="col-md-6 col-12">
                    <div class="text-center">
                        <Avatar class="border border-1 p-1" :src="full_avatar(data.avatar)" size="avatar-4xl" />
                        <div class="card mt-3">
                            <div class="card-body">
                                <h3>{{ data.name }}</h3>
                                <h6>{{ data.email }}</h6>

                                <router-link type="button" class="btn btn-info text-white mt-5"
                                    :to="{ name: 'dashboard.perfil.edit' }">
                                    <vue-feather type="edit" size="15"></vue-feather> Editar
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </DataProvider>
</template>


<script>
import DataProvider from '@/components/DataProvider.vue'
import Avatar from '@/components/Avatar.vue';
import Tooltip from '@/components/tooltip/Tooltip.vue'

export default {
    name: 'PerfilPage',
    components: { DataProvider, Avatar, Tooltip },
    methods: {

        full_avatar(avatar) {
            if (avatar != null) {
                return this.$app_url + 'storage/images/' + avatar;
            }
            return null;
        }
    },
}
</script>
