<template>
    <slot :data="data">
        <div class="text-center">
            <div class="spinner-border spinner-border text-info" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </slot>
</template>

<script>
export default {
    props: ["url"],
    data() {
        return {
            data: {},
        };
    },
    mounted() {
        // this.$store.state.themeLayout.loading = false;
        this.$http.get(this.url).then((response) => {
            this.data = response.data;
        });
    },
};
</script>
