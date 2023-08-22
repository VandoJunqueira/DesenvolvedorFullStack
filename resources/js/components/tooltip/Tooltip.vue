<template>
    <span data-bs-toggle="tooltip" tabindex="0" data-bs-placement="top" :data-bs-title="title">
        <slot> </slot>
    </span>
</template>

<script>
import { Tooltip } from 'bootstrap'

export default {
    name: 'Tooltip',
    props: {
        title: String,
    },
    mounted() {
        new Tooltip(document.body, {
            selector: "[data-bs-toggle='tooltip']",
        })
    }
};
</script>
