<template>
    <div class="d-flex p-3">
        <div class="px-3 p-2">
            <vue-feather :type="icon" size="25" class="text-black-50 d-md-inline-block d-none"></vue-feather>
            <vue-feather :type="icon" size="18" class="text-black-50 d-inline-block d-md-none"></vue-feather>
        </div>
        <div class="text-center">
            <h2>{{ count }}</h2>
            <div class="text-black-50">{{ title }}</div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'CardStats',
    props: {
        icon: String,
        count: String,
        title: String,
    },
};
</script>
