<template>
    <div class="shadow-sm row justify-content-between bg-white p-4 position-fixed" id="nav-bar-top">
        <div class="col-3">DDSV</div>
        <div class="col-6">

            <div class="input-group justify-content-center">
                <button class="input-group-text border-0 bg-transparent">
                    <vue-feather type="search"></vue-feather>
                </button>
                <input type="text" class="form-control border-0 form-control-lg" id="input-search"
                    placeholder="Pesquisar ou colar URL">
                <button class="input-group-text border-0 bg-transparent">
                    <vue-feather type="plus"></vue-feather>
                </button>
            </div>
        </div>
        <div class="col-3 d-flex justify-content-end">

            <button class="btn"><vue-feather type="bell" size="20" class="text-black-50"></vue-feather></button>

            <div class="dropdown">
                <button class="btn d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <Avatar src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" size="avatar-xl" />
                    <vue-feather type="chevron-down" size="18"></vue-feather>
                </button>
                <ul class="dropdown-menu shadow-sm border-0">
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li><a class="dropdown-item" href="#">Sair</a></li>
                </ul>
            </div>

        </div>
    </div>
</template>


<script>

import Avatar from '@/components/Avatar.vue';

export default {
    name: 'AppBar',
    components: { Avatar },
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
