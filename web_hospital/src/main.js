import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import routers from './vue_router'

const router = new VueRouter({
  mode:'history',
  routers,
})
Vue.use(VueRouter)

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router
}).$mount('#app')
