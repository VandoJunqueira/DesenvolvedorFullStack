<template>
    <slot :data="data">Loading...</slot>
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
