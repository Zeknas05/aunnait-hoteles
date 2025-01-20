import { createApp } from 'vue'
import router from "./router.js";
import App from './vue/App.vue'
import '../css/app.css';

const app = createApp(App).use(router);

app.mount('#app')

