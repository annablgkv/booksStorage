require('./axios')

window.Vue = require('vue')

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import router from './router'
import App from '../components/App.vue'

const app = new Vue({
  el: '#app',
  router,
  render: h => h(App)
})
