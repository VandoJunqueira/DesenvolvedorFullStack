<template>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-12">

            <div class="card">
                <div class="card-body">
                    <form action="#" id="form" class="needs-validation" novalidate>

                        <h4>Cadastrar</h4>

                        <hr>

                        <Input v-model="name" label="Nome de Usuário" aria-label="Campo para digitar o nome de usuário"
                            classes="mb-4" :errors="apiErrors.name" required="true">
                        <template #left>
                            <vue-feather type="user" size="20"></vue-feather>
                        </template>
                        </Input>

                        <Input v-model="email" type="email" label="E-mail" aria-label="Campo para digitar e-mail"
                            classes="mb-4" placeholder="Digite seu e-mail" :errors="apiErrors.email" required="true">
                        <template #left>
                            <vue-feather type="mail" size="20"></vue-feather>
                        </template>
                        </Input>

                        <Input v-model="password" label="Senha" type="password" aria-label="Campo para digitar senha"
                            classes="mb-4" placeholder="Digite sua senha" :errors="apiErrors.password" required="true">
                        <template #left>
                            <vue-feather type="lock" size="20"></vue-feather>
                        </template>
                        </Input>


                        <LoadingButton class="d-block w-100" label="Cadastrar" @click.prevent="signUp"
                            ref="loadingButton" />

                    </form>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import Input from '@/components/forms/Input.vue'
import LoadingButton from '@/components/buttons/LoadingButton.vue'
import { getItem, removeItem } from '@/utility/localStorageControl';

export default {
    name: 'SignUpPage',
    data() {
        return {
            name: '',
            email: '',
            password: '',
            apiErrors: {},
        }
    },
    components: { Input, LoadingButton },
    methods: {
        async signUp() {
            try {

                if (this.$utility.validar('form')) {

                    await this.$http.post('/sign-up', {
                        email: this.email,
                        name: this.name,
                        password: this.password
                    }).then((response) => {

                        this.$store.dispatch("login", {
                            user: response.data.user,
                            token: response.data.token,
                            status: true,
                        });


                        if (getItem('temp_url') == null) {
                            this.$refs.loadingButton.loading = false;
                            this.$router.push("/dashboard");
                        } else {
                            this.$http.post('/links', getItem('temp_url')).then((response) => {
                                this.$refs.loadingButton.loading = false;
                                removeItem('url');
                                removeItem('temp_url');

                                this.$router.push({ name: 'dashboard.details', params: { slug: response.data.slug } });
                            });
                        }

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
        }
    }
}
</script>
