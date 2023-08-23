<template>
    <div :class="['avatar', size]">
        <img :src="img_src" alt="" :onerror="imgError">
    </div>
</template>


<script>
import noAvatar from '@/img/no-avatar.png';
import imgError from '@/img/no-img.png';

export default {
    name: 'Avatar',
    data() {
        return {
            img_src: ''
        }
    },
    props: {
        src: null,
        size: ''
    },
    methods: {
        imgError() {
            this.img_src = imgError;
        }
    },
    watch: {
        src() {
            this.img_src = this.src || noAvatar;
        }
    },
    mounted() {
        this.img_src = this.src || noAvatar;
    },
}
</script>

