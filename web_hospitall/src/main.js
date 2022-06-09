import { createApp } from 'vue'
import App from './App.vue'
import { createWebHistory, createRouter } from "vue-router"
import routes from "./Router/index"
import axios from 'axios'
import VueAxios from 'vue-axios'
import store from './store/index'

const router = createRouter({
  history: createWebHistory(),
  routes,
});

const app = createApp(App)
app.use(VueAxios, axios)
app.use(store)
app.use(router).mount('#app')
