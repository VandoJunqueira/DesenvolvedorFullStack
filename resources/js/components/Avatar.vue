<template>
    <div :class="['avatar', size]">
        <img :src="src" alt="">
    </div>
</template>


<script>

export default {
    name: 'Avatar',
    props: {
        src: '',
        size: ''
    }
}
</script>

