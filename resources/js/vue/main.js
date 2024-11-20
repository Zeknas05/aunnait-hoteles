import { createApp } from 'vue'
import App from './App.vue'
import Oruga from '@oruga-ui/oruga-next';

const app = createApp(App).use(Oruga)

app.mount('#app')
