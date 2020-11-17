<template>
<div>
  <div class="row">
    <div class="col">
      <q-btn class="white"  label="Lista Utenti" @click="viewElencoAnagrafica=true;viewNuovaAnagrafica=false;" />
     
      <q-btn class="white" label="Aggiungi Anagrafica" @click="viewElencoAnagrafica=false;viewNuovaAnagrafica=true;" />
       </div>
      </div>
<div class="row"  v-if="viewElencoAnagrafica"><div class="col"><elencoAnagrafica></elencoAnagrafica></div></div>
<div class="row" v-if="viewNuovaAnagrafica"><div class="col"><nuovaAnagrafica idutente="" ></nuovaAnagrafica></div></div>
</div>


    
</template>

<script>

import nuovaAnagrafica from  '@/components/NuovaAnagrafica';
import elencoAnagrafica from  '@/components/ElencoAnagrafica';

export default {
    data(){return {viewElencoAnagrafica:true,viewNuovaAnagrafica:false,viewattiva:''}},
  
    
  components: {
    nuovaAnagrafica,elencoAnagrafica
  }
}
</script>