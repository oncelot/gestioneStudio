<template>
<div>
     <div class="row justify-center">
        <div class=" text-h4 text-center text-secondary">
          <span class="text-secondary"> Dettagli Progetto</span>
        </div>
      </div>

      <div class="row  justify-center"  >
        <div class=" col-5 col-md-3 bgmargintop" style="margin-right:9%">
            <q-input outlined v-model="value.numeroCommessa" label="Codice Commessa" />
        </div>
        <div class=" col-5 col-md-3 bgmargintop">
          <q-select  outlined v-model="value.tipoCommessa" :options="ElencotipoCommessa" label="Tipo Commessa" />
            
        
           
        </div>
      </div>
      <div class="row  justify-center"  >
        <div class=" col-12 col-md-7 bgmargintop">
            <q-input outlined v-model="value.titoloProgetto" label="Titolo del progetto" />
        </div>
      </div>
      <!-- #region ANAGRAFICA CLIENTI -->
      <div style="padding-top:20px">
        <div class="row justify-center"  style="color:grey; ">
          <div class="col-12 col-md-7 bgAree">
            <b>Aggiungi i Clienti</b>
            </div>
          </div>

        <div class="row justify-center">
          <div class="col-12 col-md-7 bgAree">
            <q-input v-model="value.cercaAnagraficaClienti"  outlined :dense=true  placeholder="Cerca Cliente da aggiungere - Inserire 3 caratteri per avviare la ricerca" @keypress=" elencoCercaAnagraficaClientiFunction()">
              <div class="autocomplete-items" v-if="value.cercaAnagraficaClienti.length > 2">
                <div class="row"  v-for="item in value.elencoCercaAnagraficaClienti" :key="item.message">
                  <div class="col">
                    <a href="#" @click="aggiungiElencoClienti(item)">  {{ item.nome }} {{item.cognome}} {{item.denominazione}}</a>
                  </div>
                </div>
              </div>
              <template v-slot:append>
                <q-icon name="search" />
                </template>
                </q-input>
              </div>
          </div>
    
    
        
    <div class="row justify-center "  style="justify-center" >
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Nome</b> </div> 
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Cognome</b> </div>
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black ">  <b>Codice Fiscale</b> </div>  
      <div class="col-1 col-md-1 bgAree" style="border-bottom:1px solid black ">  <b></b> </div>  
     
  </div>

  <div  class="row justify-center " v-for="(item,index) in value.elencoAnagraficaClienti" :key="item.message" >
    <div class="col-4 col-md-2 bgAree"> {{ item.nome }} {{ item.id }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.cognome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.codiceFiscale }}</div>
    <div class="col-1 col-md-1 bgAree"> 
    <q-btn   size="sm" round icon="delete" @click="value.elencoAnagraficaClienti.splice(index, 1)" />
  
  </div>
 
  </div>
  </div>
   <!-- #endregion -->

    <!-- collaboratori interni -->
    <div style="padding-top:20px">
    <div class="row justify-center">
      <div class="col-12 col-md-7 bgAree"><b>Collaboratori interni</b></div>
        
    </div>
    <div class="row justify-center">
      <div class="col-12 col-md-7 bgAree">
         <q-input v-model="cercaCollaboratoriInterni"  outlined :dense=true  placeholder="Inserire 3 caratteri per avviare la ricerca"  @keypress="elencoCercaCollaboratoreInternoFunction()">
          <div class="autocomplete-items" v-if="cercaCollaboratoriInterni.length > 2">
            <div class="row"  v-for="item in elencoCercaCollaboratoreInterno" :key="item.message">
              <div class="col">
                <a href="#" @click="aggiungiElencoCollaboratoreInterno(item)">  {{ item.nome }} {{item.cognome}} {{item.denominazione}}</a></div>

            </div>
          </div>  
          <template v-slot:append>
            <q-icon name="search" />
          </template>
         
        </q-input>
        </div>
       <!--  <div class="col-2"> <q-btn   label="Crea"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true"  :dense="true" /></div> -->
    </div>
    
    <div class="row justify-center"  style="">
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Nome</b> </div> 
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black ">  <b>Cognome</b> </div>
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Codice Fiscale</b> </div>  
      <div class="col-1 col-md-1 bgAree" style="border-bottom:1px solid black "></div>  
  </div>

  <div  class="row justify-center" v-for="item in value.elencoCollaboratoriInterno" :key="item.message" style="">
    <div class="col-4 col-md-2 bgAree"> {{ item.nome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.cognome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.codiceFiscale }}</div>
    <div class="col-1 col-md-1 bgAree"> 
    <q-btn   size="sm" round icon="delete" @click="value.elencoCollaboratoriInterno.splice(index, 1)" />
  
  </div>
  </div>
</div>

   <!-- FINE collaboratori interni -->

    <!-- collaboratori esterni -->
    <div style=padding-top:20px>
    <div class="row justify-center">
      <div class="col-12 col-md-7 bgAree"><b>Collaboratori Esterni</b></div>
        
    </div>
    <div class="row  justify-center">
      <div class="col-12 col-md-7 bgAree">
       <q-input v-model="cercaCollaboratoriEsterni" outlined :dense=true  placeholder="Inserire 3 caratteri per avviare la ricerca"  @keypress="elencoCercaCollaboratoreEsternoFunction()">
          <div class="autocomplete-items" v-if="cercaCollaboratoriEsterni.length > 2">
            <div class="row"  v-for="item in elencoCercaCollaboratoreEsterno" :key="item.message">
              <div class="col">
                <a href="#" @click="aggiungiElencoClientiCollaboratoreEsterno(item)">  {{ item.nome }} {{item.cognome}} {{item.denominazione}}</a></div>

            </div>
          </div>  
        <template v-slot:append>
            <q-icon name="search" />
          </template>
         
        </q-input>
        </div>
       <!-- <div class="col-2"> <q-btn   label="Crea"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" :dense="true" /></div> -->
    </div>
    
    
    <div class="row justify-center" >
      <div class="col-4 col-md-2 bgAree"  style="border-bottom:1px solid black"><b>Nome</b> </div> 
      <div class="col-4 col-md-2 bgAree"  style="border-bottom:1px solid black"><b>Cognome</b> </div>
      <div class="col-4 col-md-2 bgAree"  style="border-bottom:1px solid black"><b>Codice Fiscale</b> </div>  
      <div class="col-1 col-md-1 bgAree"  style="border-bottom:1px solid black"></div>  
  </div>

  <div  class="row justify-center" v-for="item in value.elencoCollaboratoriEnterno" :key="item.message">
    <div class="col-4 col-md-2 bgAree"> {{ item.nome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.cognome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.codiceFiscale }}</div>
     <div class="col-1 col-md-1 bgAree"> 
    <q-btn   size="sm" round icon="delete" @click="value.elencoCollaboratoriEnterno.splice(index, 1)" />
  
  </div>
  </div>
  </div>
   <!-- FINE collaboratori esterni -->
<!--
<div class="">
<div class="row"><div class="col"><div class="col-2"> <q-btn   label="Aggiungi Nuova Anagrafica" color="secondary"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" :dense="true" /></div></div></div>

</div>-->
 <q-dialog v-model="modalNuovaAnagraficaClienti" persistent>
      <q-card>
         <q-bar>
          <q-space />
          <q-btn dense="true" flat icon="close" v-close-popup>
            <q-tooltip content-class="bg-white text-primary">Close</q-tooltip>
          </q-btn>
           </q-bar>
        <q-card-section>
          <div class="text-h6">Crea Nuova Anagrafica</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-input v-model="NuovoProprietarioImmobileNome" type="text" label="Nome" />
          <q-input v-model="NuovoProprietarioImmobileCognome" type="text" label="Cognome" />
          <q-input v-model="NuovoProprietarioImmobileCodiceFiscale" type="text" label="Codice Fiscale" />
          <q-input v-model="NuovoProprietarioImmobileTelefono" type="text" label="Telefono" />
     
         </q-card-section>

        <q-card-actions align="right">
          <q-btn  label="Chiudi" color="secondary" v-close-popup />
          <q-btn  label="Aggiungi" color="primary" v-close-popup />
        </q-card-actions>
        
      </q-card>
    </q-dialog>

</div>
</template>

<script>
import Axios from 'axios';

export default {
    data(){return { 
      NuovoProprietarioImmobileNome:'',
      NuovoProprietarioImmobileCognome:'',
      NuovoProprietarioImmobileCodiceFiscale:'',
      NuovoProprietarioImmobileTelefono:'',
      modalNuovaAnagraficaClienti:false,
      cercaCollaboratoriInterni:'',
      elencoCercaCollaboratoreInterno:'',
      cercaCollaboratoriEsterni:'',
      elencoCercaCollaboratoreEsterno:'',
      ElencotipoCommessa:['privato','pubblico','superbonus']
      } },
    
    props:["value"],
    methods:{
        aggiungiElencoClienti(datiUtente)
        {
            this.value.elencoAnagraficaClienti.push({
                nome:datiUtente.nome,
                cognome:datiUtente.cognome,
                denominazione:datiUtente.denominazione,
                codiceFiscale:datiUtente.codice_fiscale,
                partitaIva:datiUtente.partita_iva,
                id:datiUtente.id,
            });
            this.value.cercaAnagraficaClienti='';
            this.value.elencoCercaAnagraficaClienti=null;
        },
        
        elencoCercaAnagraficaClientiFunction()
        {
            if (this.value.cercaAnagraficaClienti.length > 1)
            {
                Axios.get(this.linkApi+'/getCercaAnagrafica/cliente/'+this.value.cercaAnagraficaClienti).then(Response=>{console.log(Response.data);this.value.elencoCercaAnagraficaClienti= Response.data})
            }
        },
        
        elencoCercaCollaboratoreInternoFunction()
        {
            if (this.cercaCollaboratoriInterni.length>1)
            {
                Axios.get(this.linkApi+'/getCercaAnagrafica/collaboratoreInterno/'+this.cercaCollaboratoriInterni).then(Response=>{console.log(Response.data);this.elencoCercaCollaboratoreInterno= Response.data})
            }
        },
         aggiungiElencoCollaboratoreInterno(datiUtente)
         {
             this.value.elencoCollaboratoriInterno.push({
                 nome:datiUtente.nome,
                 cognome:datiUtente.cognome,
                 denominazione:datiUtente.denominazione,
                 codiceFiscale:datiUtente.codice_fiscale,
                 partitaIva:datiUtente.partita_iva,
                 id:datiUtente.id});
                 this.cercaCollaboratoriInterni='';
                 this.elencoCercaCollaboratoreInterno=null;
        },
        
        elencoCercaCollaboratoreEsternoFunction()
        {
            if (this.cercaCollaboratoriEsterni.length >1)
            {
                Axios.get(this.linkApi+'/getCercaAnagrafica/collaboratoreEsterno/'+this.cercaCollaboratoriEsterni).then(Response=>{console.log(Response.data);this.elencoCercaCollaboratoreEsterno= Response.data})
            }
        },

        aggiungiElencoClientiCollaboratoreEsterno(datiUtente)
        {
             this.value.elencoCollaboratoriEnterno.push({
                 nome:datiUtente.nome,
                 cognome:datiUtente.cognome,
                 denominazione:datiUtente.denominazione,
                 codiceFiscale:datiUtente.codice_fiscale,
                 partitaIva:datiUtente.partita_iva,
                 id:datiUtente.id});
                 this.cercaCollaboratoriEsterni='';
                 this.elencoCercaCollaboratoreEsterno=null;
        },
        
        test(e)
        {
            this.$emit('input',e);
        }
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