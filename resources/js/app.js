
import app from './config/configApp';
import router from './router'

app.use(router);
app.config.globalProperties.$app_url = 'http://localhost/';

app.mount("#app")
