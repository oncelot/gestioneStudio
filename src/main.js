import Vue from 'vue'
import Dropbox from 'dropbox'
import App from './App.vue'
import router from './router'
import './quasar'
import axios from 'axios'
import store from './store'
import auth from './auth'


auth.AuthCheck();

Vue.config.productionTip = false
Vue.prototype.linkApi = 'http://localhost:8000';
new Vue({
  
  router,axios,store,Dropbox,
  render: h => h(App),
}).$mount('#app')

