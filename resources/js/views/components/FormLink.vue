<template>
    <form action="#" class="needs-validation" novalidate id="form">
        <div class="row">

            <Input v-model="formData.title" :value="formData.title" v-if="!hide" label="Título (opcional)"
                ariaLabel="Campo para digitar o título opcional" classes="col-12 mb-4" :required="required" />

            <Input v-model="formData.long_link" v-on:keyup="isUrl()" :value="formData.long_link" type="url"
                label="Cole um URL longo" ariaLabel="Campo para colocar um URL longo" classes="col-12 mb-4"
                placeholder="Exemplo: https://super-long-link.com/shorten-it" :errors="apiErrors.long_link"
                :required="true">
            <template #left>
                <vue-feather type="link" size="20"></vue-feather>
            </template>
            </Input>

            <Input v-model.lazy="formData.slug" v-on:keyup="formatSlug" @change="checkSlug()" :value="formData.slug"
                ariaLabel="Campo para digitar o SLUG" classes="col-6 mb-4" placeholder="Exemplo: link-favorito"
                :errors="apiErrors.slug" :required="required && !this.copy">
            <template #label>
                Insira um Slug (opcional)

                <Tooltip
                    :title="'Adicione suas próprias palavras no final de um link (por exemplo, “' + $app_url + 'twitter_bits” em vez de “' + $app_url + '2ZonlUz”)'">
                    <span class="text-danger"><vue-feather type="info" size="16"></vue-feather></span>
                </Tooltip>

            </template>
            <template #left>
                {{ $app_url }}
            </template>
            </Input>

        </div>

        <LoadingButton v-if="this.$store.state.auth.user != null" label="Salvar" @handleClick="save" ref="loadingButton"
            :disabled="disabled_btn" />

        <button v-else @click="singUp" class="btn btn-info btn-lg text-white" type="button" ref="loadingButton"
            :disabled="disabled_btn">Cadastre-se
            e receba seu
            link</button>

    </form>
</template>

<script>
import Input from '@/components/forms/Input.vue'
import Tooltip from '@/components/tooltip/Tooltip.vue'
import LoadingButton from '@/components/buttons/LoadingButton.vue'
import { getItem, removeItem, setItem } from '@/utility/localStorageControl';

export default {
    name: 'CreateLinkPage',
    components: { Input, Tooltip, LoadingButton },
    data() {
        return {
            formData: {
                title: '',
                long_link: '',
                slug: '',
            },
            apiErrors: {},
            disabled_btn: false,
            router_api: '/links'
        }
    },
    props: {
        hide: {
            type: Boolean,
            default: false
        },
        copy: {
            type: Boolean,
            default: false
        },
        data: {
            type: Object,
            default: {}
        }
    },
    methods: {
        async save() {
            try {

                if (!this.isUrl()) {
                    return;
                }

                if (!this.checkSlug()) {
                    return;
                }

                if (this.$utility.validar('form')) {

                    await this.$http.post(this.router_api, this.formData).then((response) => {
                        this.$refs.loadingButton.loading = false;
                        removeItem('url');

                        this.$router.push({ name: 'dashboard.details', params: { slug: response.data.slug } });
                    });


                } else {
                    this.$refs.loadingButton.loading = false;
                }
            } catch (error) {
                console.log(error);
                this.$refs.loadingButton.loading = false;
                if (error.response && error.response.data && error.response.data.errors) {
                    this.apiErrors = error.response.data.errors;
                }
            }
        },
        isUrl() {
            this.disabled_btn = true
            this.apiErrors = {}
            if (!this.$utility.isURL(this.formData.long_link) && this.formData.long_link != null) {
                this.$refs.loadingButton.loading = false;
                this.apiErrors = {
                    long_link: ['Precisa ser uma URL válido!']
                };
                return false;
            }

            this.disabled_btn = false
            return true;
        },
        async checkSlug() {
            if (this.formData.slug != '') {
                this.disabled_btn = true

                await this.$http.post('/links/slug', { slug: this.formData.slug }).then((response) => {
                    this.apiErrors = {}
                    if (response.data.error) {
                        this.apiErrors = {
                            slug: ['Alguém está usando ' + this.formData.slug + '. :( Você pode tentar outra coisa ou deixar em branco.']
                        };
                        return false;
                    }

                    this.disabled_btn = false
                    return true;
                });
            }
            this.disabled_btn = false

        },
        formatSlug() {
            this.formData.slug = this.$utility.slug(this.formData.slug)
        },
        init() {
            // Verifica se os dados foram passados (edição ou cópia)
            if (Object.keys(this.data).length > 0) {

                this.formData = {
                    title: this.data.title,
                    long_link: this.data.long_link,
                };

                // Verifica se não é uma cópia, ou seja, uma edição de um registro existente
                if (!this.copy) {
                    this.router_api = `${this.router_api}/${this.data.id}`;  // Atualiza a rota da API para edição
                    this.formData.slug = this.data.slug;
                    this.formData._method = 'PUT';
                }
            }

            const storedUrl = getItem('url');
            if (storedUrl) {
                this.formData.long_link = storedUrl;
            }
        },
        singUp() {

            if (!this.isUrl()) {
                return;
            }

            if (!this.checkSlug()) {
                return;
            }

            if (this.$utility.validar('form')) {
                setItem('temp_url', this.formData);
                this.$router.push({ name: 'sing-up' });
            }
        }
    },
    computed: {
        required() {
            return Object.keys(this.data).length > 0;
        },
    },
    mounted() {
        this.init();
    }
}
</script>
