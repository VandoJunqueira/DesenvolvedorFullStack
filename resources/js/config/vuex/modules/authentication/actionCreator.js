import mutations from './mutations';
// import Cookies from 'js-cookie';
import { getItem, setItem, removeItem } from '../../../../utility/localStorageControl';

const state = () => ({
    login: getItem('logedIn'),
    user: getItem('user'),
    loading: false,
    error: null,
});

const actions = {
    async login({ commit }, data) {
        try {
            setItem('logedIn', true);
            return commit('loginSuccess', data);
        } catch (err) {
            commit('loginErr', err);
        }
    },
    async logOut({ commit }) {
        try {
            commit('logoutBegin');
            removeItem('logedIn');
            commit('logoutSuccess');
        } catch (err) {
            commit('logoutErr', err);
        }
    },
};

export default {
    namespaced: false,
    state,
    actions,
    mutations,
};
