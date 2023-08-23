import { createApp } from 'vue';
import App from '../views/App.vue'
import store from './vuex/store';
import utility from '../utility';

import { DataService } from './DataService';
import VueFeather from 'vue-feather';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp(App);

app.component(VueFeather.name, VueFeather);

app.use(store);
app.use(VueSweetalert2);
app.use(Toast);

app.config.globalProperties.$utility = utility;
app.config.globalProperties.$http = DataService;

export default app;
