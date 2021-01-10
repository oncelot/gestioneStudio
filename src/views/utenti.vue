<template>
 <div class="q-pa-md" style="color:grey">
    
  
  <q-tabs  v-model="menu" inline-label style="background-color:#fdfdfd"  >
      <q-tab name="listautenti"  icon="account_box" label="Lista Utenti"  />
      <q-tab name="nuovoutente"  icon="person_add" label="Crea Utente"  /> 
     
     
    </q-tabs> 
    <div  v-if="menu =='nuovoutente' " class="">
        <nuovoutente iduser=''></nuovoutente>
    </div>
    <div v-if="menu =='listautenti' ">
    <div class="row justify-center">

    <div class="col-3" style="text-align:center">
      <span class="text-h5 text-primary" >Lista Utenti</span><br>
    </div>
    </div>

 <div class="row justify-center">
  <div class="col-3">
    <label for=""><strong>Cerca</strong></label>
    <q-input v-model="cercaUtenti" type="text" :dense="true" outlined placeholder="nome, email,ruolo" style="padding-bottom:10px"  />
    </div>
  </div>
    <div class="row justify-center "  style="justify-center" >
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Nome</b> </div> 
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Email</b> </div>
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black ">  <b>Ruolo</b> </div>  
     
     
  </div>

  <div  class="row justify-center " v-for="item in utentiFilter" :key="item.message" >
    <div class="col-4 col-md-2 bgAree"> <a href="#" @click="dettagliUser(item.id)" >{{ item.nome }}</a></div>
    <div class="col-4 col-md-2 bgAree"> {{ item.email }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.ruolo }}</div>
    
    </div>
</div>
<div v-if="menu == 'dettagliutente'" >
    <nuovoutente  v-bind:iduser="idUser"></nuovoutente>
  <!--  dettagli utente - {{idUser}}<br>
    <label for="" style="font-weight:bold" >Nome</label>
    {{datiUser.nome}}
    <label for="" style="font-weight:bold" >Email</label>
    {{datiUser.email}}
    <label for="" style="font-weight:bold" >Ruolo</label>
    {{datiUser.ruolo}}
-->
    </div>
 </div>
</template>
<script>
//import auth from '@/auth'
import nuovoutente from '@/components/users';
import Axios from 'axios';
export default {
    data(){return {
        elencoUsers:[],
        menu:'listautenti',
        idUser:null,
        datiUser:{nome:'',email:'',ruolo:'' },
        cercaUtenti:'',
    }},
    methods:{
        dettagliUser(idUsers){
        this.menu='dettagliutente';
        this.idUser=idUsers;
      /*  Axios.post(this.linkApi+'/lista-users/'+idUsers).then(response=>{
            this.datiUser.nome=response.data[0].name;
        })
*/
    },
    listaUtenti(){
        Axios.get(this.linkApi+'/lista-users').then(response=>{
            response.data.forEach(element => {
                this.elencoUsers.push({
                    'id':element.id,
                    'nome':element.name,
                    'email':element.email,
                    'ruolo':element.role,
                    })  
                });
            })
        }},
    beforeMount:function(){
       this.listaUtenti();
  
    },
    components:{nuovoutente},
    computed:{
        utentiFilter:function(){
      return  this.elencoUsers.filter(post=>{
            return post.email.toLowerCase().includes(this.cercaUtenti.toLowerCase())
            || post.ruolo.toLowerCase().includes(this.cercaUtenti.toLowerCase())
            || post.nome.toLowerCase().includes(this.cercaUtenti.toLowerCase())
        })
        }
    }
}
</script>