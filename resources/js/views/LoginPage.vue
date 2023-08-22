<template>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-12">

            <div class="card">
                <div class="card-body">
                    <form action="#" v-on:submit.prevent="login">

                        <h4>Entrar</h4>

                        <hr>

                        <Input v-model="email" label="E-mail" aria-label="Campo para digitar e-mail" classes="mb-4"
                            placeholder="Digite seu e-mail">
                        <template #left>
                            <vue-feather type="mail" size="20"></vue-feather>
                        </template>
                        </Input>

                        <Input v-model="password" label="Senha" type="password" aria-label="Campo para digitar senha"
                            classes="mb-4" placeholder="Digite sua senha">
                        <template #left>
                            <vue-feather type="lock" size="20"></vue-feather>
                        </template>
                        </Input>


                        <button class="btn d-block w-100 btn-lg btn-info text-white"
                            aria-label="Botão para entrar">Entrar</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import Input from '@/components/forms/Input.vue'

export default {
    name: 'HomePage',
    data() {
        return {
            email: '',
            password: '',
        }
    },
    components: { Input },
    methods: {
        async login() {
            try {
                const response = await this.$http.post('/login', {
                    email: this.email,
                    password: this.password
                });


                this.$store.dispatch("login", {
                    user: response.data.user,
                    token: response.data.token,
                    status: true,
                });
                this.$router.push("/dashboard");

                // Redirecione ou faça outras ações após o login bem-sucedido
            } catch (error) {
                console.error('Erro ao efetuar login', error);
            }
        }
    }
}
</script>
