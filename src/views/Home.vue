<template>
<div>
   <h2 class="text-primary" style="text-align:center">Benevenuto sul portale Gestione studio</h2>
   <div  v-if="!isAuth">
   <login ></login>
   </div>
   
   </div>

<!--
<div>
    <button @click="test321()">proba</button>
    <li v-for="item in listFileDbx" :key="item.message">
      <a :href="link+item.path_lower"  target="_blank"> {{ item.name }}</a>
<span @click="downloadFileFromDbx(item.path_lower)"> {{ item.name }}</span> 
  </li>
</div> -->
</template>
<script>
import login from '@/views/login.vue';

import {mapGetters} from 'vuex'
export default {
  components: { login },
    data(){
  return {
      leftDrawerOpen: false,miniState: true
    }
    },
     computed:{
    ...mapGetters({
      isAuth:'GET_AUTH',
      user:'GET_AUTH_USER',

    })
  }
  }
/*
const Dropbox = require("dropbox").Dropbox;
export default {
    data(){
          return {
            listFileDbx:[],
            link:'https://www.dropbox.com/preview/Applicazioni/testGestionestudio',
             dbx:new Dropbox({accessToken:this.test}),
              test:"hl9kNUA-2XoAAAAAAAAAAYZNEAeJjkO2Z4_vcaQ4xiJ-dZ-oZB4DWXHAxohVHauy",
          apikey:"ogdhen8zm9emvmy",
          }},
          methods:{
            downloadFileFromDbx(idfile){
              
             let output= this.dbx.filesDownload({path:idfile}).then(response=>{return response});
             console.log(output);
            },
              test321(){ 
                return 'coap';
             }
             },
          mounted() {
          this.dbx = new Dropbox({accessToken:this.test});   
                     this.dbx.filesDownload
     this.dbx.filesListFolder({path:''}).then(response => {
       let listacartellle=response;
       listacartellle.result.entries.forEach(element => {
         this.listFileDbx.push(element);
          

       });
        
         
        })
        .catch(error=> {
          console.error(error);
        });
        
          },
        

        }
*/
    </script>