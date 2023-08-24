<template>
    <div class="floating-button d-flex justify-content-center align-items-center bg-info" @click="handleButtonClick">
        <vue-feather type="plus"></vue-feather>
    </div>
</template>

<script>
export default {
    name: 'FloatingButton',
    methods: {
        handleButtonClick() {
            this.$router.push({ name: 'dashboard.create' });
        },
    },
};
</script>

<style>
.floating-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    text-align: center;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s, transform 0.3s;
}
</style>
