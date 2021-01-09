import Vue from 'vue'
import VueRouter from 'vue-router'
import NuovoProgetto from '@/views/nuovo-progetto'
import ListaProgetti from '@/views/lista-progetti'
import anagrafica from '@/views/anagrafica'
import dettaglioProgetto from '@/views/dettaglioProgetto'
import RegistrazioneUtente from '@/views/Registrazione-utente'
import utenti from '@/views/utenti'
import login from '@/views/login'
import store from '@/store'
import baseApi from '@/baseApi'

Vue.use(VueRouter)

const Middleware = ()=>{
return async (to,from,next)=>{
  const user = store.getters.GET_AUTH_USER;
  let myRole = user.role;
  const auth=store.getters.GET_AUTH;
  //const myRole=store.getters.GET_AUTH_USER.role;
  const isRequiredAuth=to.matched.some(r => r.meta.requiredAuth);
  const hasRoles= to.matched.some(r => r.meta.userRoles);
  if (isRequiredAuth && localStorage.getItem('token') === null ){
    return next('/login');
  }
  if (hasRoles){
    let arrayRoles= to.meta.userRoles;
    if (auth===false){
      const response = await baseApi().get('/user');
      if (!response.data.error){
      store.dispatch('SET_AUTH_USER',response.data.user.user);
      store.dispatch('SET_TOKEN',response.data.user.token);
      store.dispatch('SET_AUTH',true);
      localStorage.setItem('token',response.data.user.token.value);
      myRole= response.data.user.user.role;
      }

    }

    if(arrayRoles.indexOf(myRole)<-1){
    alert('non hai accesso a questa pagina');
     return  next(false);
    }
  }
  next();
}
}

const routes = [
  {path: '/nuovo-progetto', component:NuovoProgetto,
        meta:{
          requiredAuth:true,
          userRoles:['admin']
        },
      beforeEnter:Middleware(),
      },
  {path: '/utenti', component:utenti,
        meta:{
          requiredAuth:true,
          userRoles:['admin']
        },
      beforeEnter:Middleware(),
      },
  {path: '/lista-progetti', component:ListaProgetti},
  {path: '/anagrafica', component:anagrafica},
  {path: '/dettaglio-progetto/:id', component:dettaglioProgetto},
  {path: '/login', component:login},
  {path: '/Registrazione-utente', component:RegistrazioneUtente},
]

// eslint-disable-next-line no-new
const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
