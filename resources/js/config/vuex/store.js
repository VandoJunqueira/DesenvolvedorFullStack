import { createStore } from 'vuex';
import auth from './modules/authentication/actionCreator';

export default createStore({
  modules: {
    auth,
  },
});
