<template>
    <div class="row justify-content-center mt-3">

        <div class="col-md-6 col-12">
            <div class="d-flex justify-content-center">
                <AvatarUploadInput :image="full_avatar" @response="setAvatar" />
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="#" id="form" class="needs-validation" novalidate>

                        <Input v-model="name" :value="name" label="Nome de Usuário"
                            aria-label="Campo para digitar o nome de usuário" classes="mb-4" :errors="apiErrors.name"
                            required="true">
                        <template #left>
                            <vue-feather type="user" size="20"></vue-feather>
                        </template>
                        </Input>

                        <Input v-model="email" :value="email" type="email" label="E-mail"
                            aria-label="Campo para digitar e-mail" classes="mb-4" placeholder="Digite seu e-mail"
                            :errors="apiErrors.email" required="true">
                        <template #left>
                            <vue-feather type="mail" size="20"></vue-feather>
                        </template>
                        </Input>

                        <Input v-model="password" :value="password" label="Senha" type="password"
                            aria-label="Campo para digitar senha" classes="mb-4" placeholder="Digite sua senha"
                            :errors="apiErrors.password">
                        <template #left>
                            <vue-feather type="lock" size="20"></vue-feather>
                        </template>
                        </Input>


                        <LoadingButton class="d-block w-100" label="Salvar Alterações" @click.prevent="save"
                            ref="loadingButton" />

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import DataProvider from '@/components/DataProvider.vue'
import Avatar from '@/components/Avatar.vue';
import Tooltip from '@/components/tooltip/Tooltip.vue'
import AvatarUploadInput from '@/components/forms/AvatarUploadInput.vue'
import Input from '@/components/forms/Input.vue'
import LoadingButton from '@/components/buttons/LoadingButton.vue'

export default {
    name: 'PerfilEditPage',
    components: { DataProvider, Avatar, Tooltip, AvatarUploadInput, Input, LoadingButton },
    data() {
        return {
            name: '',
            email: '',
            password: '',
            avatar: '',
            apiErrors: {},
        }
    },
    methods: {
        setAvatar(avatar) {
            this.avatar = avatar.file_name;
        },
        async save() {
            try {

                if (this.$utility.validar('form')) {

                    await this.$http.update('/perfil', {
                        email: this.email,
                        name: this.name,
                        password: this.password,
                        avatar: this.avatar
                    }).then((response) => {
                        this.$refs.loadingButton.loading = false;
                        this.$store.dispatch("user", response.data);
                        this.$router.push("/dashboard/perfil");
                    });

                } else {
                    this.$refs.loadingButton.loading = false;
                }

            } catch (error) {
                this.$refs.loadingButton.loading = false;
                if (error.response && error.response.data && error.response.data.errors) {
                    this.apiErrors = error.response.data.errors;
                }
            }
        },
    },
    computed: {
        full_avatar() {
            if (this.avatar != null) { return this.$app_url + 'storage/images/' + this.avatar; }
            return null;

        }
    },
    mounted() {
        this.$http.get('/perfil').then((response) => {
            let data = response.data || {};

            this.name = data.name
            this.email = data.email
            this.password = null
            this.avatar = data.avatar

        });
    },
}
</script>
