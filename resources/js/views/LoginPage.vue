<template>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-12">

            <div class="card">
                <div class="card-body">
                    <form action="#" class="needs-validation" novalidate id="form">

                        <h4>Entrar</h4>

                        <hr>

                        <Input v-model="email" label="E-mail" aria-label="Campo para digitar e-mail" classes="mb-4"
                            placeholder="Digite seu e-mail" :errors="apiErrors.email" required="true">
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


                        <LoadingButton class="d-block w-100" label="Entrar" @click="login" ref="loadingButton" />

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
    name: 'LoginPage',
    data() {
        return {
            email: '',
            password: '',
            apiErrors: {},
        }
    },
    components: { Input, LoadingButton },
    methods: {
        async login() {
            try {
                if (this.$utility.validar('form')) {

                    await this.$http.post('/login', {
                        email: this.email,
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
