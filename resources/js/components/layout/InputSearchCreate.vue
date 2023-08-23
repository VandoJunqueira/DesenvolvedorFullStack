<template>
    <div>

        <div class="input-group justify-content-center">
            <button class="input-group-text border-0 bg-transparent">
                <vue-feather type="search"></vue-feather>
            </button>

            <input v-model="url" type="text" @change="searchOrCreate" class="form-control border-0 form-control-lg"
                id="input-search" placeholder="Pesquisar ou colar URL">

            <button class="input-group-text border-0 bg-transparent">
                <vue-feather type="plus"></vue-feather>
            </button>
        </div>
    </div>
</template>

<script>

import { setItem, removeItem } from '@/utility/localStorageControl';

export default {
    name: 'InputSearchCreate',
    data() {
        return {
            url: ''
        }
    },
    methods: {
        searchOrCreate() {
            removeItem('url');

            if (this.url != '') {

                if (this.$utility.isURL(this.url)) {
                    setItem('url', this.url);
                    this.$router.push({ name: 'dashboard.create' });
                } else {
                    this.$router.push('/dashboard?search=' + this.url);
                }
                this.url = '';

            }

        }
    }
}
</script>


<style scoped>
#input-search {
    border-radius: 5px;
    max-width: 900px;
    background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity));
}

#input-search::placeholder {
    text-align: center;
}
</style>
