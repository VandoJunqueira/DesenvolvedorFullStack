<template>
    <div id="backdrop" class="d-flex justify-content-center align-items-center">

        <div class="spinner-border spinner-border text-info" style="width: 4rem; height: 4rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>

    </div>
</template>

<script>

export default {
    name: 'NotFound',
    data() {
        return {
            slug: ''
        }
    },
    methods: {
        async redirect() {

            await this.$http.post(this.$route.path).then((response) => {
                window.location.replace(response.data.long_link);
            });


        }
    },
    mounted() {
        this.redirect();
    },
}
</script>

<style>
#backdrop {
    background-color: #fff;
    position: absolute;
    z-index: 1000000000;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
</style>
