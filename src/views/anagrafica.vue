<template>
<div  style="color:grey; background-color:#f2f4f8; ">
  <q-tabs  v-model="tab" inline-label style="background-color:#fdfdfd"  >

      <q-tab name="listautenti"  icon="account_box" label="Lista Utenti"  />
      <q-tab name="nuovaAnagrafica"  icon="person_add" label="Aggiungi Anagrafica" /> 
     
    </q-tabs> 
 
<div class="row"  v-if=" tab=='listautenti'"><div class="col"><elencoAnagrafica></elencoAnagrafica></div></div>
<div class="row" v-if="tab=='nuovaAnagrafica'"><div class="col"><nuovaAnagrafica idutente="" ></nuovaAnagrafica></div></div>
</div>


    
</template>

<script>

import nuovaAnagrafica from  '@/components/NuovaAnagrafica';
import elencoAnagrafica from  '@/components/ElencoAnagrafica';

export default {
    data(){return {
      tab:'listautenti'}},
  
    
  components: {
    nuovaAnagrafica,elencoAnagrafica
  }
}
</script>