<template>
    <button class="btn btn-lg btn-info text-white" aria-label="Botão para entrar" :disabled="loading" @click.prevent="handleClick"
        type="button">
        <span v-if="!loading">{{ label }}</span>
        <span v-else>
            <div class="spinner-border spinner-border text-light" style="width: 27px; height: 27px;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </span>
    </button>
</template>

<script>
export default {
    props: {
        label: {
            type: String,
            default: 'Entrar'
        }
    },
    data() {
        return {
            loading: false
        };
    },
    methods: {
        async handleClick() {
            this.loading = true;
            this.$emit('handleClick');
        }
    }
};
</script>
