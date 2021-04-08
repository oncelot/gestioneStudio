<template>
  <q-layout view="hHh Lpr lff" style=" background-color:#f2f4f8;">
    <q-header >
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          @click="leftDrawerOpen = !leftDrawerOpen"
          aria-label="Menu"
          icon="menu"
        />

        <q-toolbar-title>
         Gestionale Cantiere
        </q-toolbar-title>
        <div v-if="!isAuth"><span style="font-weight:bold; cursor:pointer"  @click="paginaLogin()"> Login</span></div>
        <div v-if="isAuth"><li>{{user.email}}</li> <span style="font-weight:bold; cursor:pointer" @click="logout()" >logout</span></div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above

        :mini="miniState"
        @mouseover="miniState = false"
        @mouseout="miniState = true"
        :content-style="{backgroundColor: '#d4e2e9'}"
        :width="200"
        :breakpoint="500"
        bordered
    
    >
      <q-list  style="background-color:#d4e2e9; " class="text-secondary"> 
        <q-item v-if="user.role=='admin'" clickable   to="/nuovo-progetto" exact>
          <q-item-section avatar>
            <q-icon name="add_circle_outline" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Nuovo</q-item-label>
            <q-item-label caption>Crea  progetto</q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable v-if="user.role!=''" to="/lista-progetti" exact>
          <q-item-section avatar>
            <q-icon name="view_list" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Lista progetti</q-item-label>
            <q-item-label caption></q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable v-if="user.role=='admin'"  to="/anagrafica">
          <q-item-section avatar>
            <q-icon name="people" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Anagrafica</q-item-label>
            <q-item-label caption></q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable v-if="user.role=='admin'"   to="/utenti">
          <q-item-section avatar>
            <q-icon name="account_box" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Gestione Utenti</q-item-label>
            <q-item-label caption></q-item-label>
          </q-item-section>
        </q-item>
   
      </q-list>
    </q-drawer>

    <q-page-container>
  
      <router-view></router-view>
      
    </q-page-container>
  </q-layout>
</template>

<script>
//import HelloWorld from './components/HelloWorld.vue'
import auth from '@/auth'
import {mapGetters} from 'vuex'
export default {
  computed:{
    ...mapGetters({
      isAuth:'GET_AUTH',
      user:'GET_AUTH_USER',

    })
  },
  /*name: 'LayoutDefault',

  components: {
    HelloWorld
  },
*/
  data () {
    return {
      leftDrawerOpen: false,miniState: true
    }
  },
  methods:{logout(){
    auth.LogOut(this.cred,'/');
  },
  paginaLogin(){
  this.$router.push({ path:'/login'});
  }
}
}
</script>

<style>
</style>
