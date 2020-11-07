<template>
    <div style="color:grey">
         <div class="row">
        <hr>
        <div class="col-12"><b>Tipo Anagrafica</b></div>
        <div class="col-12">
            <q-radio v-model="nuovaAnagraficaTipo" val="cliente" label="Cliente" />
            <q-radio v-model="nuovaAnagraficaTipo" val="collaboratoreInterno" label="Collaboratore Interno" />
            <q-radio v-model="nuovaAnagraficaTipo" val="collaboratoreEsterno" label="Collaboratore Esterno" />
        </div>
        </div>
<div class="row">
    <div class="col-12 col-md-3 padding10">
 <label for="" style="font-weight:bold"> Tipologia</label>
        <q-select v-model="tipologia" dense  outlined :options="options"   /></div>

    <div class="col-12 col-md-3 padding10">
         <label for=""> Denominazione</label>
        <q-input v-model="nuovaAnagraficaDenominazione" type="text"  dense outlined placeholder="Denominazione azienda " />
    </div>

    <div class="col-12 col-md-3 padding10">
        <label for=""> Nome</label>
        <q-input v-model="nuovaAnagraficaNome" type="text" dense outlined placeholder="Denominazione azienda " />
    </div>
    <div class="col-12 col-md-3 padding10">
         <label for=""> Cognome</label>
        <q-input v-model="nuovaAnagraficaCognome" type="text" dense outlined placeholder="Denominazione azienda " />
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-3  padding10">
         <label for="">Partita Iva</label>
        <q-input v-model="nuovaAnagraficaPartitaIva" type="text" dense outlined  />
    </div>
    
    <div class="col-12 col-md-3  padding10">
         <label for="">Codice Fiscale</label>
        <q-input v-model="nuovaAnagraficaCodiceFiscale" type="text" dense outlined  />
    </div>
    <div class="col-12 col-md-3  padding10">
         <label for="">Telefono</label>
        <q-input v-model="nuovaAnagraficaTelefono" type="text" dense outlined  />
    </div>
    <div class="col-12 col-md-3  padding10">
         <label for="">Email</label>
        <q-input v-model="nuovaAnagraficaEmail" type="text" dense outlined placeholder="E-mail Separate da virgola"  />
    </div>
    <div class="col-12 col-md-3  padding10">
         <label for="">Email PEC</label>
        <q-input v-model="nuovaAnagraficaEmailPec" type="text" dense outlined placeholder="Singola Email"  />
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-3  padding10">
         <label for="">Paese</label>
        <q-input v-model="nuovaAnagraficaPaese" type="text" dense outlined  />
    </div>
    
    <div class="col-12 col-md-3  padding10">
         <label for="">Indirizzo</label>
        <q-input v-model="nuovaAnagraficaIndirizzo" type="text" dense outlined  />
    </div>
    <div class="col-12 col-md-3  padding10">
         <label for="">Città</label>
        <q-input v-model="nuovaAnagraficaCitta" type="text" dense outlined  />
    </div>
    <div class="col-12 col-md-3  padding10">
         <label for="">Provincia</label>
        <q-input v-model="nuovaAnagraficaProvincia" type="text" dense outlined  />
    </div>
    
    <div class="col-12 col-md-3  padding10">
         <label for="">CAP</label>
        <q-input v-model="nuovaAnagraficaCap" type="text" dense outlined  />
    </div>
</div>
<div class="row">

    <div class="col-md-3 col-sm-12 padding10">
        <label>Note Anagrafica</label>
        <q-input
      v-model="nuovaAnagraficaNote"
      filled
      type="textarea"
    />
    </div>
</div>

<div class="row">
    <div class="col padding10">
        <q-btn color="primary"  label="Salva"  /> 
    </div>
</div>



    </div>
</template>
<style scoped>
.padding10{padding: 10px;}

</style>
<script>
export default {
    data(){return {
        tipocliente:'',
        nuovaAnagraficaNote:'',
        nuovaAnagraficaCap:'',
        nuovaAnagraficaProvincia:'',
        nuovaAnagraficaCitta:'',
        nuovaAnagraficaIndirizzo:'',
        nuovaAnagraficaPaese:'',
        nuovaAnagraficaEmailPec:'',
        nuovaAnagraficaEmail:'',
        nuovaAnagraficaPartitaIva:'',
        nuovaAnagraficaTelefono:'',
        nuovaAnagraficaCodiceFiscale:'',
        nuovaAnagraficaDenominazione:'',
        nuovaAnagraficaNome:'',
        nuovaAnagraficaCognome:'',
        nuovaAnagraficaTipo:'',
        options: [
            {label:'Seleziona...', value:''},
            {label:'Azienda', value:'azienda'},
            {label:'Persona Fisica', value:'personafisica'},
            {label:'Pubblica amministrazione', value:'publicaamministrazione'},
            {label:'Condominio', value:'condominio'}
       
      ]
        }
        }
}
</script>