<template>
    <div style="color:grey">
         <div class="row">
        
        <div class="col-8 col-md-3 padding10">
             <label for="" style="font-weight:bold"> Tipo Anagrafica</label>
            <q-select v-model="nuovoAnagrafica.nuovaAnagraficaTipo" :dense="true"  :disable="!InputAttivi"   outlined :options="optionstipoAnagrafica"  v-bind:value="optionstipoAnagrafica.value"  />

        </div>
        <div class="col-md-3 col-2">

            <q-btn color="secondary" style="margin-top:30px" icon="edit" @click="InputAttivi=true" />
        </div>
        </div>
<div class="row">
    <div class="col-12 col-md-3 padding10">
 <label for="" style="font-weight:bold"> Tipologia</label>
        <q-select v-model="nuovoAnagrafica.tipologia" :dense="true"   :disable="!InputAttivi"   outlined :options="optionsTipo"  v-bind:value="optionsTipo.value"  /></div>

    <div class="col-12 col-md-3 padding10">
         <label for=""> Denominazione</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaDenominazione" :disable="!InputAttivi" type="text"  :dense="true" outlined placeholder="Denominazione azienda " />
    </div>

    <div class="col-12 col-md-3 padding10">
        <label for=""> Nome</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaNome"  :disable="!InputAttivi"   type="text" :dense="true" outlined />
    </div>
    <div class="col-12 col-md-3 padding10">
         <label for=""> Cognome</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaCognome"  :disable="!InputAttivi"  type="text" :dense="true" outlined />
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-3  padding10">
         <label for="">Partita Iva</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaPartitaIva" :disable="!InputAttivi"  type="text" :dense="true" outlined  />
    </div>
    
    <div class="col-12 col-md-3  padding10">
         <label for="">Codice Fiscale</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaCodiceFiscale"  :disable="!InputAttivi"  type="text" :dense="true" outlined  />
    </div>
    <div class="col-12 col-md-3  padding10">
         <label for="">Telefono</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaTelefono"  :disable="!InputAttivi"   type="text" :dense="true" outlined  />
    </div>
    <div class="col-12 col-md-3  padding10">
         <label for="">Email</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaEmail" type="text"  :disable="!InputAttivi" :dense="true" outlined placeholder="E-mail Separate da virgola"  />
    </div>
    <div class="col-12 col-md-3  padding10">
         <label for="">Email PEC</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaEmailPec" type="text"  :disable="!InputAttivi"   :dense="true" outlined placeholder="Singola Email"  />
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-3  padding10">
         <label for="">Paese</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaPaese" type="text"  :disable="!InputAttivi"   :dense="true" outlined  />
    </div>
    
    <div class="col-12 col-md-3  padding10">
         <label for="">Indirizzo</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaIndirizzo" type="text"  :disable="!InputAttivi"   :dense="true" outlined  />
    </div>
    <div class="col-12 col-md-3  padding10">
         <label for="">Città</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaCitta" type="text"  :disable="!InputAttivi"  :dense="true" outlined  />
    </div>
    <div class="col-12 col-md-3  padding10">
         <label for="">Provincia</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaProvincia" type="text"  :disable="!InputAttivi"   :dense="true" outlined  />
    </div>
    
    <div class="col-12 col-md-3  padding10">
         <label for="">CAP</label>
        <q-input v-model="nuovoAnagrafica.nuovaAnagraficaCap" type="text"  :disable="!InputAttivi"   :dense="true" outlined  />
    </div>
</div>
<div class="row">

    <div class="col-md-3 col-sm-12 padding10">
        <label>Note Anagrafica</label>
        <q-input
      v-model="nuovoAnagrafica.nuovaAnagraficaNote"
      filled
      type="textarea"
    />
    </div>
</div>

<div class="row">
    <div class="col padding10">
        <q-btn color="primary"  label="Salva" v-if="bottoneSalvaModifica=='salva'" @click=" aggiungiAnagrafica()"  /> 
        <q-btn color="primary"  label="Aggiorna" v-if="bottoneSalvaModifica=='modifica' && InputAttivi" @click=" modificaAnagrafica(idutente) "   /> 
    </div>
</div>



    </div>
</template>
<style scoped>
.padding10{padding: 10px;}

</style>
<script> 

const axios = require('axios');
export default {
  props: ['idutente'],
    data(){return {
        nuovoAnagrafica:{

        tipocliente:'',
        tipologia:'',
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

        },
        optionsTipo: [
            {label:'Seleziona...', value:''},
            {label:'Azienda', value:'azienda'},
            {label:'Persona Fisica', value:'personafisica'},
            {label:'Pubblica amministrazione', value:'publicaamministrazione'},
            {label:'Condominio', value:'condominio'}
       
      ],
        optionstipoAnagrafica: [
            {label:'Seleziona...', value:''},
            { label:'Cliente (Persona Fisica)', value:'clienteFisico'},
            {label:'CLiente (Persona Giuridica)', value:'clienteGiuridico'},
            {label:'Fornitore', value:'Fornitore'},
            {label:'Collaboratore Interno', value:'collaboratoreInterno'},
            {label:'Collaboratore Esterno', value:'collaboratoreEsterno'},
            {label:'Impresa Edile', value:'impresaEdile'},
            {label:'Pubblica Amministrazione', value:'publiccaAmministrazione'}
       
      ],
      bottoneSalvaModifica:'',
      InputAttivi:false,

        }
        },methods:{
     async aggiungiAnagrafica(){

          // aggiungi(this.nuovoAnagrafica);
           //   console.log(test.response);
           var rispostaServer=null;
                 const datiAnagrafica =this.nuovoAnagrafica;
              rispostaServer= await
               axios.post(this.linkApi+'/aggiungi-anagrafica',datiAnagrafica)
               .then((response) => response.data);
               if (rispostaServer.response=='ok'){
                   this.nuovoAnagrafica.tipocliente='',
         this.nuovoAnagrafica.tipologia='',
         this.nuovoAnagrafica.nuovaAnagraficaNote='',
         this.nuovoAnagrafica.nuovaAnagraficaCap='',
         this.nuovoAnagrafica.nuovaAnagraficaProvincia='',
         this.nuovoAnagrafica.nuovaAnagraficaCitta='',
         this.nuovoAnagrafica.nuovaAnagraficaIndirizzo='',
         this.nuovoAnagrafica.nuovaAnagraficaPaese='',
         this.nuovoAnagrafica.nuovaAnagraficaEmailPec='',
         this.nuovoAnagrafica.nuovaAnagraficaEmail='',
         this.nuovoAnagrafica.nuovaAnagraficaPartitaIva='',
         this.nuovoAnagrafica.nuovaAnagraficaTelefono='',
         this.nuovoAnagrafica.nuovaAnagraficaCodiceFiscale='',
         this.nuovoAnagrafica.nuovaAnagraficaDenominazione='',
         this.nuovoAnagrafica.nuovaAnagraficaNome='',
         this.nuovoAnagrafica.nuovaAnagraficaCognome='',
         this.nuovoAnagrafica.nuovaAnagraficaTipo='',
                alert('Anagrafica carica con successo');
               }else{alert('errore caricamento '+rispostaServer.message);}

               //console.log(rispostaServer.response);
               },
               modificaAnagrafica(idutente){
                   const modificaAnagrafica=this.nuovoAnagrafica;
                   axios.post(this.linkApi+'/modifica-anagrafica/'+idutente+"/",modificaAnagrafica).then(response=>{
                       console.log(response.data);
                       if (response.data.response=='ok'){
                           alert('utente Aggiornato');
                           }else{alert('Errore aggiornamento utente');}
                   });
               }

               

            }, 
            beforeMount:function (){
                if (this.idutente==''){this.bottoneSalvaModifica='salva'}
                if (this.idutente!=''){
                    this.bottoneSalvaModifica='modifica';
               axios.get(this.linkApi+'/getAnagrafica/'+this.idutente+'/').then(response =>{ 
                //this.nuovoAnagrafica.nuovaAnagraficaNome = response.data[0].nome; 
                    this.nuovoAnagrafica.nuovaAnagraficaTipo = response.data[0].tipo_anagrafica;
                    this.nuovoAnagrafica.tipologia = response.data[0].tipologia;
                    this.nuovoAnagrafica.nuovaAnagraficaNote = response.data[0].note;
                    this.nuovoAnagrafica.nuovaAnagraficaCap = response.data[0].cap;
                    this.nuovoAnagrafica.nuovaAnagraficaProvincia = response.data[0].provincia;
                    this.nuovoAnagrafica.nuovaAnagraficaCitta = response.data[0].citta;
                    this.nuovoAnagrafica.nuovaAnagraficaIndirizzo = response.data[0].indirizzo;
                    this.nuovoAnagrafica.nuovaAnagraficaPaese = response.data[0].paese;
                    this.nuovoAnagrafica.nuovaAnagraficaEmailPec = response.data[0].pec;
                    this.nuovoAnagrafica.nuovaAnagraficaEmail = response.data[0].email;
                    this.nuovoAnagrafica.nuovaAnagraficaPartitaIva = response.data[0].partita_iva;
                    this.nuovoAnagrafica.nuovaAnagraficaTelefono = response.data[0].telefono;
                    this.nuovoAnagrafica.nuovaAnagraficaCodiceFiscale = response.data[0].codice_fiscale;
                    this.nuovoAnagrafica.nuovaAnagraficaDenominazione = response.data[0].denominazione;
                    this.nuovoAnagrafica.nuovaAnagraficaNome = response.data[0].nome;
                    this.nuovoAnagrafica.nuovaAnagraficaCognome = response.data[0].cognome;
                   

                     return response.data;
                }).catch(err => {
        alert(err.message);
      });}
                
            }

}

</script>