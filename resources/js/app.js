import './bootstrap';
import VueFeather from 'vue-feather';
import "bootstrap/dist/js/bootstrap.js";
import router from './router'

import { createApp } from 'vue'
import App from './views/App.vue'

const app = createApp(App);

app.component(VueFeather.name, VueFeather);
app.use(router);

app.config.globalProperties.$http = window.axios;
app.config.globalProperties.$app_url = 'http://localhost/';

app.mount("#app")
