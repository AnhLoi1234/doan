import { createApp } from 'vue'
import App from './App.vue'
import { createWebHistory, createRouter } from "vue-router"
import routes from "./Router_admin"
import axios from 'axios'
import VueAxios from 'vue-axios'

const router = createRouter({
    history: createWebHistory(),
    routes,
  });

const app = createApp(App)
app.use(VueAxios, axios) 
app.use(router).mount('#app')
