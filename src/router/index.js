import Vue from 'vue'
import VueRouter from 'vue-router'
import NuovoProgetto from '@/views/nuovo-progetto'
import ListaProgetti from '@/views/lista-progetti'
import anagrafica from '@/views/anagrafica'
import dettaglioProgetto from '@/views/dettaglioProgetto'


Vue.use(VueRouter)



const routes = [
  {path: '/nuovo-progetto', component:NuovoProgetto},
  {path: '/lista-progetti', component:ListaProgetti},
  {path: '/anagrafica', component:anagrafica},
  {path: '/dettaglio-progetto/:id', component:dettaglioProgetto},
]

// eslint-disable-next-line no-new
const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
