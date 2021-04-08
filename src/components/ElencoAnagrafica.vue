<template>
<div class="justify-center">
  <div class="row justify-center">

    <div class="col-3" style="text-align:center">
      <span class="text-h5 text-primary" >Anagrafica Utenti</span><br>
    </div>
    </div>

 <div class="row justify-center">
  <div class="col-10 col-md-3">
    <label for=""><strong>Cerca</strong></label>
    <q-input v-model="cercaAnagrafica" type="text" :dense="true" outlined placeholder="nome, cognome, codice fiscale, partita iva, ragione sociale" style="padding-bottom:10px"  />
    </div>
  </div>
    
 <div class="row">
  <div class="col">Nome</div>
  <div class="col">Cognome</div>
  <div class="col">Codice Fiscale</div>
  </div>
  <div  class="row" v-for="item in elencoAnagraficaFilter" :key="item.message"  style="border-bottom:1px solid black">
    <div class="col" ><a href="#" @click="dettagliutente(item.id)"> {{ item.nome }}</a></div>
    <div class="col"> {{ item.cognome }}</div>
    <div class="col"> {{ item.codice_fiscale }}</div>
  </div>
  <q-dialog v-model="modalNuovaAnagraficaClienti" persistent
      :maximized="maximizedToggle=true"
      transition-show="slide-up"
      transition-hide="slide-down">
      <q-card>
         <q-bar>
          <q-space />
          <q-btn :dense="true" flat icon="close" v-close-popup>
            <q-tooltip content-class="bg-white text-primary">Close</q-tooltip>
          </q-btn>
           </q-bar>
        <q-card-section>
          <div class="text-h6">Crea Nuova Anagrafica</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
       <dettaglioAnagrafica v-bind:idutente="nomePassaggio"></dettaglioAnagrafica>
         </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Chiudi" color="primary" v-close-popup />
        </q-card-actions>
        
      </q-card>
    </q-dialog>
</div>

</template>
<script>
import Axios from 'axios'
import dettaglioAnagrafica from  '@/components/NuovaAnagrafica';
export default {
    data(){return{
      elencoAnagrafica:[{nome:'',cognome:''}],
      modalNuovaAnagraficaClienti:false,
      nomePassaggio:'',
      cercaAnagrafica:''}
      
      },
    computed:{
      elencoAnagraficaFilter:function(){
        return this.elencoAnagrafica.filter(post => {
            return post.nome.toLowerCase().includes(this.cercaAnagrafica.toLowerCase()) 
            || post.cognome.toLowerCase().includes(this.cercaAnagrafica.toLowerCase()) 
            || post.denominazione.toLowerCase().includes(this.cercaAnagrafica.toLowerCase())
            || post.codice_fiscale.toLowerCase().includes(this.cercaAnagrafica.toLowerCase())
            || post.partita_iva.toLowerCase().includes(this.cercaAnagrafica.toLowerCase());
            }
            )}},
    methods:{
       dettagliutente(idutente){
       this.nomePassaggio=idutente;
       this.modalNuovaAnagraficaClienti=true;
        /* Axios.get(this.linkApi+'/getAnagrafica/'+idutente+'/').then(response =>{
          this.nomePassaggio=response.data;
          console.log('dasadaad');
          this.modalNuovaAnagraficaClienti=true;
        } );*/

        //this.nomePassaggio=infoutente[0];
        //console.log(infoutente[0].nome);
        // this.modalNuovaAnagraficaClienti=true;
//alert(infoutente);
      }
      },
      components:{dettaglioAnagrafica},
    beforeMount: function() {
        Axios.get(this.linkApi+'/getAnagrafica').then(Response =>(this.elencoAnagrafica=Response.data));
  
  },
}
</script>