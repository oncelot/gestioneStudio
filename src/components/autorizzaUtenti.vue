<template>
    <div>

 <div class="row justify-center"  style="color:grey; ">
      <div class="col-12 col-md-7 bgAree"><b>Autorizza Utenti</b></div>
      
    </div>
    <div class="row justify-center">
      <div class="col-12 col-md-7 bgAree">
        <q-input v-model="CercaUtentiDaAutorizzare" debounce="1"  outlined :dense=true  placeholder="Cerca Utente da Autorizzare - Inserire 4 caratteri per avviare la ricerca" @keypress=" elencoCercaUsersFunction()">
          <div class="autocomplete-items" v-if="CercaUtentiDaAutorizzare.length > 2">
            <div class="row"  v-for="item in elencoCercaUtentiDaAutorizzare" :key="item.message">
              <div class="col">
                <a href="#" @click="autorizzaUtente(item)">  {{ item.nome }} {{item.email}} {{item.ruolo}}</a></div>

            </div>
          </div>
          <template v-slot:append>
            <q-icon name="search" />
          </template>
         
        </q-input>
        </div>
        <!-- <div class="col-2"> <q-btn   label="Crea"   :dense='true' icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" /></div> -->
    </div>
      <div class="row justify-center "  style="justify-center" >
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Nome</b> </div> 
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Email</b> </div>
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black ">  <b>Ruolo</b> </div>  
      <div class="col-1 col-md-1 bgAree" style="border-bottom:1px solid black ">  <b></b> </div>  
     
  </div>

  <div  class="row justify-center " v-for="(item,index) in value.elencoUtentiDaAutorizzare" :key="item.message" >
    <div class="col-4 col-md-2 bgAree"> {{ item.nome }} - {{ item.id }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.email }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.ruolo }}</div>
    <div class="col-1 col-md-1 bgAree"> 
    <q-btn   size="sm" round icon="delete" @click="value.elencoUtentiDaAutorizzare.splice(index, 1)" />
  
  </div>

  </div>


  <div class="row justify-center"  style="color:grey; " v-if="value.elencoUtentiDaAutorizzare.length > 0">
      <div class="col-12 col-md-7 bgAree"><q-btn color="primary" icon="check" label="Autorizza" @click="autorizzaUtenti()" /></div>
      
    </div>
 
  <div class="row justify-center"  style="color:grey; padding-top:30px" >
      <div class="col-12 col-md-7 bgAree"><b>Utenti Autorizzati</b></div>
      
    </div>
 
 <div  class="row justify-center " v-for="item in value.elencoUtentiAutorizzati" :key="item.message" >
    <div class="col-4 col-md-2 bgAree"> {{ item.nome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.email }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.ruolo }}</div>
    <div class="col-1 col-md-1 bgAree"> 
    <q-btn   size="sm" round icon="delete" @click="cancellaUtente(item.idRiga)" /></div>
    </div>
    </div>
</template>
<script>
import Axios from 'axios';

export default {
    data(){
        return{
            CercaUtentiDaAutorizzare:'',
            elencoCercaUtentiDaAutorizzare:[],
            }
    },
    props:["value"],
    methods:{
        
        elencoCercaUsersFunction()
        {
            if (this.CercaUtentiDaAutorizzare.length > 1)
            {
                Axios.get(this.linkApi+'/getCercaUsersDaAutorizzare/'+this.idprogetto+'/'+this.CercaUtentiDaAutorizzare).then(Response=>{console.log(Response.data);this.elencoCercaUtentiDaAutorizzare= Response.data})
            }
        },
        
        autorizzaUtente(datiUtente)
        {
            this.value.elencoUtentiDaAutorizzare.push({
                nome:datiUtente.name,
                email:datiUtente.email,
                ruolo:datiUtente.role,
                id:datiUtente.id,
                });
            this.CercaUtentiDaAutorizzare='';
            this.elencoCercaUtentiDaAutorizzare=null;
        },      
        autorizzaUtenti()
        {
            const sendDaAutorizzare={
                listaDaAutorizzare:this.valueelencoUtentiDaAutorizzare,
                idprogetto:this.idprogetto};
                
            Axios.post(this.linkApi+'/SetAutorizzaUtenti',sendDaAutorizzare).then(Response =>{
                if(Response.data.response=='ok')
                {
                    this.elencoUtentiAutorizzati=[];
                    Axios.get(this.linkApi+'/getUtentiAutorizzati/'+this.value.idprogetto).then(ResponseAutorizzati=>
                    
                    {
                        ResponseAutorizzati.data['listaUsersAssociatiAlProgetto'].forEach(element => {
                            this.value.elencoUtentiAutorizzati.push({
                                nome:element.name,
                                email:element.email,
                                ruolo:element.role,
                                id:element.id_user,
                                idRiga:element.id
                                });
                            });
                    });
                    
                    this.value.elencoUtentiDaAutorizzare=[];
                    this.messaggioDaVisualizzare='Utenti Autorizzati';
                    this.visualizzamessaggio=true;
                    
                }else
                {
                    this.messaggioDaVisualizzare=Response.data.message;
                    this.visualizzamessaggio=true;
                }
            });
        },

        cancellaUtente(id)
        {
            Axios.delete(this.linkApi+'/cancellaAutorizzazione/'+id).then(response=>{
          if(response.data.response=='ok'){
             this.value.elencoUtentiAutorizzati=[];
           Axios.get(this.linkApi+'/getUtentiAutorizzati/'+this.value.idprogetto).then(ResponseAutorizzati=>
            {
              ResponseAutorizzati.data['listaUsersAssociatiAlProgetto'].forEach(element => {
                this.value.elencoUtentiAutorizzati.push({
                  nome:element.name,
                  email:element.email, 
                  ruolo:element.role,
                  id:element.id_user,
                  idRiga:element.id
                  });
                  });
              });
              this.value.elencoUtentiDaAutorizzare=[];
            this.messaggioDaVisualizzare='Utente Cancellato';
            this.visualizzamessaggio=true;
          }else{
              this.messaggioDaVisualizzare=Response.data.message;
              this.visualizzamessaggio=true;
          }
        });

      },
 
    }
}
</script>
<style scoped>
.bgmargintop{
  background-color: white; margin-top:20px;
}
.bgAree{
  background-color: white;padding:5px
}
.paddingInput{padding:10px;}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
  
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}
</style>
