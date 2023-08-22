<template>
    <div class="card mt-5">
        <div class="card-body ps-5 pe-5">

            <h3 class="mb-4">Encurtar um link longo</h3>

            <form action="">
                <div class="row">{{ teste }}
                    <Input v-model="teste" label="Cole um URL longo" ariaLabel="Campo para colocar um URL longo"
                        classes="col-12 mb-4" placeholder="Exemplo: https://super-long-link.com/shorten-it">
                    <template #left>
                        <vue-feather type="link" size="20"></vue-feather>
                    </template>
                    </Input>


                    <Input v-model="teste" ariaLabel="Campo para digitar o SLUG" classes="col-6 mb-4"
                        placeholder="Exemplo: link-favorito">
                    <template #label>
                        Insira um Slug (opcional)

                        <Tooltip
                            :title="'Adicione suas próprias palavras no final de um link (por exemplo, “' + $app_url + 'twitter_bits” em vez de “' + $app_url + '2ZonlUz”)'">
                            <vue-feather type="info" size="14"></vue-feather>
                        </Tooltip>

                    </template>
                    <template #left>
                        {{ $app_url }}
                    </template>
                    </Input>

                </div>

                <button class="btn btn-primary btn-lg">
                    Cadastre-se e receba seu link
                </button>

            </form>
        </div>
    </div>
</template>

<script>
import Input from '@/components/forms/Input.vue'
import Tooltip from '@/components/tooltip/Tooltip.vue'

export default {
    name: 'HomePage',
    components: { Input, Tooltip },
}
</script>
