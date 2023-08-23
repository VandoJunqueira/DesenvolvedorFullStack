import { createStore } from 'vuex';
import auth from './modules/authentication/actionCreator';
import actions from './modules/actions/actionCreator';

export default createStore({
    modules: {
        auth,
        actions
    },
});
