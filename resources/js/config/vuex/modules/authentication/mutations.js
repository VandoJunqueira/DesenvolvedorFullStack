
import { setItem, removeItem } from '@/utility/localStorageControl'

export default {
    loginBegin(state) {
        state.login = true;
    },

    loginSuccess(state, data) {
        state.loading = false;
        state.login = data.status;
        state.user = data.user;

        console.log('loginSuccess', data);

        setItem('user', data.user);
        setItem('token', data.token);
    },

    loginErr(state, err) {
        state.loading = false;
        state.error = err;
    },

    logoutBegin(state) {
        state.loading = true;
    },

    logoutSuccess(state) {
        state.loading = false;
        state.login = null;
        state.user = null;
        removeItem('user');
        removeItem('token');
    },

    logoutErr(state, err) {
        state.loading = false;
        state.error = err;
    },
};
