import Vue from 'vue'
import App from './App.vue'
import router from './router'
import './quasar'
import axios from 'axios'
import store from './store'
import auth from './auth'


auth.AuthCheck();

Vue.config.productionTip = false
Vue.prototype.linkApi = '';
new Vue({
  
  router,axios,store,
  render: h => h(App),
}).$mount('#app')

