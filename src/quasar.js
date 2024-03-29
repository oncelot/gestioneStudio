import Vue from 'vue'

import './styles/quasar.scss'
import '@quasar/extras/material-icons/material-icons.css'
import { Quasar,Notify } from 'quasar'

Vue.use(Quasar, {
  config: {
    notify: { /* look at QUASARCONFOPTIONS from the API card (bottom of page) */ }
  },
  plugins: { Notify
  }
 })