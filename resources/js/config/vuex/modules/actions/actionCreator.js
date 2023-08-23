import mutations from './mutations';

const state = () => ({
    delete: {},
});

const actions = {
    async deleteItem({ commit }, data) {
        return commit('deleteSuccess', data);
    },
};

export default {
    namespaced: false,
    state,
    actions,
    mutations,
};
