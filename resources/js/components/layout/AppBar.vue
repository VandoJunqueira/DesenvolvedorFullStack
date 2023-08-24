<template>
    <div class="shadow-sm row justify-content-between bg-white p-4 position-fixed" id="nav-bar-top">
        <div class="col-3">

            <a href="/"><img :src="logo" height="45" alt="Logo"></a>

        </div>

        <InputSearchCreate class="col-6" />

        <div v-if="user == null" class="col-3 d-flex justify-content-end">

            <router-link type="button" class="btn btn-outline-dark me-2 align-items-center d-flex"
                :to="{ name: 'login' }">Entrar</router-link>
            <router-link type="button" class="btn btn-info text-white align-items-center d-flex"
                :to="{ name: 'sing-up' }">Cadastrar</router-link>

        </div>

        <div v-else class="col-3 d-flex justify-content-end">

            <button class="btn"><vue-feather type="bell" size="20" class="text-black-50"></vue-feather></button>

            <div class="dropdown">
                <button class="btn d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <Avatar :src="full_avatar" size="avatar-xl" />
                    <vue-feather type="chevron-down" size="18"></vue-feather>
                </button>
                <ul class="dropdown-menu shadow-sm border-0">
                    <li>
                        <div class="dropdown-item pt-2">
                            <div class="text-center">
                                <div>
                                    <Avatar class="border border-1 p-1" :src="full_avatar" size="avatar-3xl" />
                                </div>
                                <div>{{ user.name }}</div>
                                <div class="small text-muted">{{ user.email }}</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="border border-bottom border-1"></div>
                    </li>
                    <li>
                        <router-link type="button" class="dropdown-item" :to="{ name: 'dashboard.perfil' }">
                            <vue-feather type="user" size="14"></vue-feather> Perfil
                        </router-link>
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="#" @click.prevent="logout">
                            <vue-feather type="log-out" size="14"></vue-feather> Sair
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>


<script>

import Avatar from '@/components/Avatar.vue';
import InputSearchCreate from '@/components/layout/InputSearchCreate.vue';
import Logo from '@/img/logo.png';

export default {
    name: 'AppBar',
    components: { Avatar, InputSearchCreate },
    data() {
        return {
            user: {},
            logo: Logo
        }
    },
    methods: {
        logout() {
            this.$store.dispatch("logOut");
            this.$router.push("/");
        }
    },
    computed: {
        full_avatar() {
            if (this.user.avatar != null) { return this.$app_url + 'storage/images/' + this.user.avatar; }
            return null;

        }
    },
    mounted() {
        this.user = this.$store.state.auth.user;
    },
    watch: {
        '$store.state.auth.user'(user) {
            this.user = user;
        }
    },
}
</script>

<style scoped>
#nav-bar-top {
    z-index: 99998;
}
</style>
