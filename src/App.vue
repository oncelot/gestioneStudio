<template>
  <q-layout view="hHh Lpr lff">
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
{{isAuth}}
        <div v-if="!isAuth"><a href="/login"> Login</a></div>
        <div v-if="isAuth"><li>{{user.name}}</li> <a href="/logout">logout</a></div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
 show-if-above

        :mini="miniState"
        @mouseover="miniState = false"
        @mouseout="miniState = true"

        :width="200"
        :breakpoint="500"
        bordered
        
        
        style="background-color:#d4e2e9"
    >
      <q-list  style="background-color:#d4e2e9; " class="text-secondary"> 
        <q-item clickable   to="/nuovo-progetto" exact>
          <q-item-section avatar>
            <q-icon name="add_circle_outline" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Nuovo</q-item-label>
            <q-item-label caption>Crea  progetto</q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable  to="/lista-progetti" exact>
          <q-item-section avatar>
            <q-icon name="view_list" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Lista progetti</q-item-label>
            <q-item-label caption></q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable  to="/anagrafica">
          <q-item-section avatar>
            <q-icon name="people" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Anagrafica</q-item-label>
            <q-item-label caption></q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable  to="/anagrafica">
          <q-item-section avatar>
            <q-icon name="account_box" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Gestione Utenti</q-item-label>
            <q-item-label caption></q-item-label>
          </q-item-section>
        </q-item>
     <!--   <q-item clickable tag="a" target="_blank" href="https://chat.quasar.dev">
          <q-item-section avatar>
            <q-icon name="chat" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Discord Chat Channel</q-item-label>
            <q-item-label caption>chat.quasar.dev</q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable tag="a" target="_blank" href="https://forum.quasar.dev">
          <q-item-section avatar>
            <q-icon name="forum" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Forum</q-item-label>
            <q-item-label caption>forum.quasar.dev</q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable tag="a" target="_blank" href="https://twitter.com/quasarframework">
          <q-item-section avatar>
            <q-icon name="rss_feed" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Twitter</q-item-label>
            <q-item-label caption>@quasarframework</q-item-label>
          </q-item-section>
        </q-item>-->
      </q-list>
    </q-drawer>

    <q-page-container>
  
      <router-view></router-view>
      
    </q-page-container>
  </q-layout>
</template>

<script>
//import HelloWorld from './components/HelloWorld.vue'

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
  }
}
</script>

<style>
</style>
