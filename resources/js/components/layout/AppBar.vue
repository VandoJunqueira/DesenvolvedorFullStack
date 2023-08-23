<template>
    <div class="shadow-sm row justify-content-between bg-white p-4 position-fixed" id="nav-bar-top">
        <div class="col-3">LOGO</div>

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
                    <Avatar :src="user.avatar" size="avatar-xl" />
                    <vue-feather type="chevron-down" size="18"></vue-feather>
                </button>
                <ul class="dropdown-menu shadow-sm border-0">
                    <li>
                        <div class="dropdown-item pt-2">
                            <div class="text-center">
                                <div>
                                    <Avatar class="border border-1 p-1" :src="user.avatar" size="avatar-3xl" />
                                </div>
                                <div>{{ user.name }}</div>
                                <div class="small text-muted">{{ user.email }}</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="border border-bottom border-1"></div>
                    </li>
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li><a class="dropdown-item" href="#" @click.prevent="logout">Sair</a></li>
                </ul>
            </div>

        </div>
    </div>
</template>


<script>

import Avatar from '@/components/Avatar.vue';
import InputSearchCreate from '@/components/layout/InputSearchCreate.vue';

export default {
    name: 'AppBar',
    components: { Avatar, InputSearchCreate },
    data() {
        return {
            user: {}
        }
    },
    methods: {
        logout() {
            this.$store.dispatch("logOut");
            this.$router.push("/");
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
