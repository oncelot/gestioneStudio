

<template>
<!--q-pa-md-->
<div class=" " style="color:grey; background-color:#f2f4f8; width:100%">
  
  <q-tabs  v-model="tab" inline-label style="background-color:#fdfdfd"  >
      <q-tab name="progetto"  icon="home_work" label="Progetto"  />
      <q-tab name="anagraficaIntervento"  icon="alarm" label="Anagrafica intervento" /> 
      <q-tab name="screening"  icon="movie" label="Screening" />
      <q-tab name="datiStrutturali"  icon="build" label="Dati Strutturali" />
      <q-tab name="allegati"  icon="attach_file" label="Allegati" />
      <q-tab name="quote"  icon="euro_symbol" label="Quote" />
      <q-tab name="associaUtenti"  icon="engineering" label="Permessi" />
     
    </q-tabs> 

 <div v-if="tab == 'progetto'">
   <step1 v-model="Progetto" ></step1>
 </div>
 
 <div v-if="tab == 'anagraficaIntervento'">
   <step2 v-model="Progetto" ></step2>
  </div>

  <div v-if="tab=='screening'" style="color:grey">
    <step3 v-model="Progetto" ></step3>
  </div>
  <div v-if="tab=='datiStrutturali'" style="color:grey">
    <step4 v-model="Progetto" ></step4>
  </div>



<div v-if="tab == 'allegati'">

<span class="text-h5">Allegati</span>

  
<div class="row">
  <div class="col-3">
     <label class="text-bold"> Allegato</label><br>
     <input type="file" @change="handleFile"  >
  <!--<q-file v-model="allegatoDiAllegati"   label="Carica file"  outlined :dense="true"   style="max-width: 300px" /> -->
  </div>
  <div class="col-6">  
    <label class="text-bold"> Tipo Allegato</label>
    <q-select v-model="tipoAllegatodiAllegati" :options="tipiDiAllegati" :dense="true" outlined label="Seleziona..."  />
    <q-input v-if="tipoAllegatodiAllegati.value =='altro'" v-model="tipoAltroAllegato" type="text" label="Altro tipo allegato" :dense=true />
  </div>
   <div class="col-12"> 
    <label for="" class="text-bold"> Note</label>
    <q-input v-model="noteallegatoDiallegati" outlined :dense="true" type="text"  />  
  </div>
  <div class="col-12" style="margin-top:10px;"><q-btn class="white" icon="add" label="Aggiungi" @click="addrowAllegati()" /></div>
   
     </div>
<div class="row" style="margin-top:20px"> 
  <div class="col">File</div>
  <div class="col">Note</div>
  <div class="col">Tipo Documento</div>
  <div class="col"></div>
  
</div>
<div  v-for="(allegato,index) in elencoAllegati" :key="allegato.nomeFile">
 <div class="row" v-if="allegato.cancellare=='0'">
  <div class="col">
    <span v-if="allegato.idprogetto != '0'"  @click="downloadFile(idprogetto+'/'+allegato.nomeFile, allegato.nomeFile)" style=" cursor: pointer; text-decoration:underline">{{allegato.nomeFile}}</span>
    <span v-if="allegato.idprogetto == '0'" >{{allegato.nomeFile}}</span>
     </div>
  <div class="col">{{allegato.noteFile}}</div>
  <div class="col">{{allegato.tipoAllegato}}</div>
  <div class="col"> <q-btn   size="sm" round icon="delete" @click="elencoAllegati[index].cancellare='1'" />
  </div>
  </div>

</div>

</div>


<div v-if="tab == 'quote'">


<div class="row  q-gutter-sm bgAree"><div class="col-8 col-md-3">
  <label for="" class="font-weigth:bold">Quota Preventivo €</label>
  <q-input v-model="quotaPreventivo" :dense="true" outlined type="number" /></div>

  <div class="col-2 col-md-2"> 
    <label for="" class="text-bold"> Allega Preventivo Firmato</label>
    <input type="file" @change="handleFilePreventivo">
      <a href="#"  v-if="!nuovoProgetto" @click="downloadFile(idprogetto+'/'+quoteAllegatoPreventivo,quoteAllegatoPreventivo)" >{{quoteAllegatoPreventivo}}</a>
   
  <!--  <q-file
      v-model="quoteAllegatoPreventivo"
      label="Carica file"
      outlined
      :dense="true"
      style="max-width: 300px" /> -->
      </div>
  </div>

  <div class="bgAree" style="margin-top:20px" >
<div class="row">
  <div class="col">
    <span class="text-h6 text-secondary">Acconti Ricevuti</span>
  </div>
</div>
  
  <div class="row  q-gutter-sm " style="padding-top:20px">
    <div class="col-6 col-md-2 ">
      <label class="text-bold">Data</label>
     <q-input  outlined :dense="true"  v-model="dataAcconto" mask="date" :rules="['date']">
      <template v-slot:append>
        <q-icon name="event" class="cursor-pointer">
          <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
            <q-date v-model="dataAcconto">
              <div class="row items-center justify-end">
                <q-btn v-close-popup label="Close" color="primary" flat />
              </div>
            </q-date>
          </q-popup-proxy>
        </q-icon>
      </template>
    </q-input>
    </div>
    <div class="col-6 col-md-2 ">
      <label for="" class="text-bold">Importo</label>
      <q-input v-model="quotaImportoAcconto" outlined :dense="true"  type="number" />
      </div>
   
    <div class="col-6 col-md-2 ">
      <label for="" class="text-bold">Modalità di pagamento</label>
    
      <q-select v-model="quotaAccontoModalitaPagamento" :options="elencoMetodoPagamenti" outlined :dense="true" /></div>
    <div class="col-6 col-md-3 ">
      <label for="" class="text-bold">Chi ha fatturato</label>
      <q-input v-model="quoteChiFattura" type="text" outlined :dense="true"  />
    </div>
    
    <div class="col-6 col-md-2">
      <q-btn icon="add" style="margin-top:25px"  color="primary" @click="addrowQuoteAcconti(); " outline :dense="true" />
    </div>
   
    
    </div>

<div class="row bgAree">
  <div class="col text-bold">Quota</div>
  <div class="col text-bold">Importo</div>
  <div class="col text-bold">Metodo di Pagamento</div>
  <div class="col text-bold">Chi Fatturato</div>
   <div class="col text-bold"></div>
  </div>
<div class="row bgAree"  v-for="(quota,index) in elencoQuote" :key="quota.quota">
 <div class="col">{{quota.dataPagamento}}</div>
  <div class="col"> {{quota.importo}}</div>
   <div class="col">{{quota.metodoPagamento}}</div>
  <div class="col">{{quota.chiFatturato}}</div>
  <div class="col"> 
    <q-btn   size="sm" round icon="delete" @click="elencoQuote.splice(index, 1)" />
  
  </div>
 

</div>
</div>


  <div class="bgAree" style="margin-top:20px" >
<div class="row">
  <div class="col">
    <span class="text-h6 text-secondary">Spese Effettuate</span>
  </div>
</div>
  
  <div class="row  q-gutter-sm " style="padding-top:20px">

    <div class="col-6 col-md-2 ">
      <label class="text-bold">Data</label>
     <q-input  outlined :dense="true"  v-model="dataSpesaEffettuata" mask="date" :rules="['date']">
      <template v-slot:append>
        <q-icon name="event" class="cursor-pointer">
          <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
            <q-date v-model="dataSpesaEffettuata">
              <div class="row items-center justify-end">
                <q-btn v-close-popup label="Close" color="primary" flat />
              </div>
            </q-date>
          </q-popup-proxy>
        </q-icon>
      </template>
    </q-input>
    </div>

    <div class="col-6 col-md-2 ">
      <label for="" class="text-bold">Importo</label>
      <q-input v-model="importoSpesaEffettuata" outlined :dense="true"  type="number" />
      </div>
   
    <div class="col-6 col-md-2 ">
      <label for="" class="text-bold">Causale</label>
      <q-input v-model="causaleSpesaEffettuata" outlined :dense="true"  type="text" />
 </div>
     <div class="col-6 col-md-3 ">
      <label for="" class="text-bold">Chi ha Pagato</label>
      <q-input v-model="chiHafattoSpesa" type="text" outlined :dense="true"  />
    </div>
    
    <div class="col-6 col-md-2">
      <q-btn icon="add" style="margin-top:25px"  color="primary" @click="addrowQuoteSpese(); " outline :dense="true" />
    </div>
   
    
    </div>

<div class="row bgAree">
  <div class="col text-bold">Quota</div>
  <div class="col text-bold">Importo</div>
  <div class="col text-bold">Causale</div>
  <div class="col text-bold">Chi ha pagato</div>
  <div class="col text-bold"></div>
  </div>
<div class="row bgAree" v-for="(quota,index) in elencoSpese" :key="quota.dataPagamento" >
 <div class="col">{{quota.dataPagamento}}</div>
  <div class="col"> {{quota.importo}}</div>
   <div class="col">{{quota.causale}}</div>
  <div class="col">{{quota.chiHapagato}}</div>
  <div class="col"> 
    <q-btn   size="sm" round icon="delete" @click="elencoSpese.splice(index, 1)" />
  
  </div>


</div>


</div>

<q-btn color="primary" v-if="nuovoProgetto" icon="check" label="Crea progetto" @click="aggiungiProgetto()" />
<q-btn color="positive" v-if="!nuovoProgetto" icon="check" label="Aggiorna progetto" @click="aggiungiProgetto()" />


</div>

<!-- #region Associa Utenti-->
<div v-if="tab == 'associaUtenti'">

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

  <div  class="row justify-center " v-for="(item,index) in elencoUtentiDaAutorizzare" :key="item.message" >
    <div class="col-4 col-md-2 bgAree"> {{ item.nome }} - {{ item.id }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.email }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.ruolo }}</div>
    <div class="col-1 col-md-1 bgAree"> 
    <q-btn   size="sm" round icon="delete" @click="elencoUtentiDaAutorizzare.splice(index, 1)" />
  
  </div>

  </div>


  <div class="row justify-center"  style="color:grey; " v-if="elencoUtentiDaAutorizzare.length > 0">
      <div class="col-12 col-md-7 bgAree"><q-btn color="primary" icon="check" label="Autorizza" @click="autorizzaUtenti()" /></div>
      
    </div>
 
  <div class="row justify-center"  style="color:grey; padding-top:30px" >
      <div class="col-12 col-md-7 bgAree"><b>Utenti Autorizzati</b></div>
      
    </div>
 
 <div  class="row justify-center " v-for="item in elencoUtentiAutorizzati" :key="item.message" >
    <div class="col-4 col-md-2 bgAree"> {{ item.nome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.email }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.ruolo }}</div>
    <div class="col-1 col-md-1 bgAree"> 
    <q-btn   size="sm" round icon="delete" @click="cancellaUtente(item.idRiga)" /></div>
    </div>

</div>
<!-- #endregion-->
<!-- #region MODAL-->
<!-- MODAL -->

<q-dialog v-model="modalAggiungiAllegatiInterventiSuccessiviAllaCostruzione" persistent>
  <q-card>
    <q-card-section class="row items-center">
     
      <span class="q-ml-md">Aggiungi</span>
    </q-card-section>
    <q-card-section class="row items-center">
    
      <span class="q-ml-md">
        <q-input v-model="modalInterventiSuccessiviNuovoSub" type="text" label="sub" />
        <q-input v-model="modalInterventiSuccessiviNuovaDecrizione" type="text" label="descrizione" />
       <q-file
      v-model="modalInterventiSuccessiviNuovoAllegato"
      label="Carica file"
      filled
      style="max-width: 300px" />
      
        </span>
    </q-card-section>
    <q-card-actions align="right">
      <q-btn flat label="Annulla" color="primary" v-close-popup />
      <q-btn flat label="Conferma" color="primary" @click="addrowInterventiSuccessivi();"/>
    </q-card-actions>
  </q-card>
</q-dialog>






<q-dialog persistent  v-model="visualizzamessaggio">
        <q-card>
  <q-card-section class="row items-center">
      {{messaggioDaVisualizzare}}
  </q-card-section>
  <q-card-actions align="right">
      <q-btn flat label="ok" color="primary" v-close-popup @click="redirectlistaprogetti()" />
    
    </q-card-actions>
        </q-card>
    </q-dialog>


<!-- FINE  MODAL -->
<!-- #endregion -->
  </div> <!-- quello iniziale con TAB -->

</template>
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

<script>
//import formNuovaanagrafica from '@/components/NuovaAnagrafica'
//import message from '@/components/messaggio'
import Axios from 'axios';

import step1 from '@/components/step1Progetto.vue';
import step2 from '@/components/step2AnagraficaIntervento.vue';
import step3 from '@/components/step3Screening.vue';
import step4 from '@/components/step4DatiStrutturali.vue';

export default {


    methods: {
      checkboxValue: function(params) {
      this.check = params;
    },
    cancellaUtente(id){
        Axios.delete(this.linkApi+'/cancellaAutorizzazione/'+id).then(response=>{
          if(response.data.response=='ok'){
             this.elencoUtentiAutorizzati=[];
           Axios.get(this.linkApi+'/getUtentiAutorizzati/'+this.idprogetto).then(ResponseAutorizzati=>
            {
              ResponseAutorizzati.data['listaUsersAssociatiAlProgetto'].forEach(element => {
                this.elencoUtentiAutorizzati.push({
                  nome:element.name,
                  email:element.email, 
                  ruolo:element.role,
                  id:element.id_user,
                  idRiga:element.id
                  });
                  });
              });
              this.elencoUtentiDaAutorizzare=[];
            this.messaggioDaVisualizzare='Utente Cancellato';
            this.visualizzamessaggio=true;
          }else{
              this.messaggioDaVisualizzare=Response.data.message;
              this.visualizzamessaggio=true;
          }
        });

      },
      autorizzaUtenti()
      {
        const sendDaAutorizzare={
          listaDaAutorizzare:this.elencoUtentiDaAutorizzare,
          idprogetto:this.idprogetto
        };
        Axios.post(this.linkApi+'/SetAutorizzaUtenti',sendDaAutorizzare).then(Response =>{
          if(Response.data.response=='ok'){
            this.elencoUtentiAutorizzati=[];
            Axios.get(this.linkApi+'/getUtentiAutorizzati/'+this.idprogetto).then(ResponseAutorizzati=>
            {
              ResponseAutorizzati.data['listaUsersAssociatiAlProgetto'].forEach(element => {
                this.elencoUtentiAutorizzati.push({
                  nome:element.name,
                  email:element.email, 
                  ruolo:element.role,
                  id:element.id_user,
                   idRiga:element.id
                  });
                  });
              });
              this.elencoUtentiDaAutorizzare=[];
            this.messaggioDaVisualizzare='Utenti Autorizzati';
            this.visualizzamessaggio=true;
            }else{
              
              this.messaggioDaVisualizzare=Response.data.message;
              this.visualizzamessaggio=true;
              }
            });
      },
    downloadFile(path,titoloFile){
        Axios({
          url: this.linkApi+'/download/?pp='+path,
          method:'get',
          responseType: 'arraybuffer',
          }).then(response=>{
            console.log(response);
            if(response.data.byteLength >2){
            
            const url = window.URL.createObjectURL(new Blob([response.data]))
            const link = document.createElement('a')
            link.href = url
            link.setAttribute('download',titoloFile)
            document.body.appendChild(link)
            link.click()}
            else{
              alert('Errore file non esistente');

            }
            });
      },
    aggiungiProgetto(){
      const  sendForm={
        idprogetto:this.idprogetto,
          titoloProgetto:this.Progetto.titoloProgetto,
         tipologiaEdificio:this.tipologiaEdificio,
         zonaClimatica:this.zonaClimatica,
         gradigiornoText:this.gradigiornoText ,
          areavincolata42:this.areavincolata42 ,
          tipoVincolo42:this.areaVicnolata42TipoVincolo,
          zonasismisca4:this.zonasismisca4 ,
          zonasismisca4Interventiantisismici:this.zonasismisca4Interventiantisismici ,
          zonasismisca4InterventiantisismiciAltriVincoli:this.zonasismisca4InterventiantisismiciAltriVincoli ,
          TipoInterventoProposto:this.TipoInterventoProposto ,
          TipologiainterventoDPR3802001:this.TipologiainterventoDPR3802001 ,

          tipologiaTitoloAutorizzativi:this.tipologiaTitoloAutorizzativi ,
          riferimentiAutorizzativi:this.riferimentiAutorizzativi,
          dateAutorizzativi:this.dateAutorizzativi,
          AllegatoTitoloAutorizzativo:this.AllegatoTitoloAutorizzativo,
          Base64AllegatoTitoloAutorizzativo:this.Base64AllegatoTitoloAutorizzativo,

          abusiEdilizi:this.abusiEdilizi,
          TipologiaAbusiEdilizi:this.TipologiaAbusiEdilizi,
          comuneStatoDiFatto:this.comuneStatoDiFatto,
          NCEUStatoDiFatto:this.NCEUStatoDiFatto,
          difformitaUrbanistiche:this.difformitaUrbanistiche,
          noteDifformitaUrbanistiche:this.noteDifformitaUrbanistiche,
          difformitaCatastali:this.difformitaCatastali,
          noteDifformitaCatastali:this.noteDifformitaCatastali,
          irregolaritaSanabili:this.irregolaritaSanabili,
          noteIrregolaritaSanabili:this.noteIrregolaritaSanabili,

          datistrutturalichk:this.datistrutturalichk,
          altroDatiStrutturali:this.altroDatiStrutturali,

          tipologiaParetechk:this.tipologiaParetechk,
          altroTipologiaParetechk:this.altroTipologiaParetechk,

          tipologia_doppia_parete:this.tipologia_doppia_parete,
          SpessoreMuriEsterni:this.SpessoreMuriEsterni,
          SpessoreCameraDaria:this.SpessoreCameraDaria,
          SpessoreIsolamento:this.SpessoreIsolamento,
          TipologiaIsolamentoIncameraDaria:this.TipologiaIsolamentoIncameraDaria,
          isolamentoEsistentechk:this.isolamentoEsistentechk,
          altroisolamentoEsistentechk:this.altroisolamentoEsistentechk,

          tipologiaImpiantoEsistente:this.tipologiaImpiantoEsistente,
          cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente:this.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente,
          cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro:this.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro,
          cetraleTermicaCentralizzatoNumeroUnita:this.cetraleTermicaCentralizzatoNumeroUnita,
          cetraleTermicaCentralizzatoAnnoInstallazione:this.cetraleTermicaCentralizzatoAnnoInstallazione ,
          cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente:this.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente ,
          cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste:this.cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste ,
          cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente:this.cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente,
          cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato:this.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato ,
          cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato:this.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato ,
          cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate:this.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate ,
          cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato:this.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato ,
          cetraleTermicaCentralizzatoCertificatoCPI:this.cetraleTermicaCentralizzatoCertificatoCPI ,
          cetraleTermicaCentralizzatoCertificatoCPIAllegato:this.cetraleTermicaCentralizzatoCertificatoCPIAllegato ,
          cetraleTermicaCentralizzatoTecnologiaImpiantoProposto:this.cetraleTermicaCentralizzatoTecnologiaImpiantoProposto ,
          cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro:this.cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro ,
          cetraleTermicaCentralizzatoNumeroUnitaProposte:this.cetraleTermicaCentralizzatoNumeroUnitaProposte ,
          cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto:this.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto ,
          centraleTermivaCentralizzatoVettoreImpianto:this.centraleTermivaCentralizzatoVettoreImpianto ,
          quotaPreventivo:this.quotaPreventivo,

          quoteAllegatoPreventivo:this.nameAuxFilePreventivo,
          base64AllegatoPreventivo:this.quoteAllegatoPreventivo,
          elencoAcconti:this.elencoQuote,
          elencoSpese:this.elencoSpese,

          clienti:this.elencoAnagraficaClienti,
          collaboratoriInterni:this.elencoCollaboratoriInterno,
          collaboratoriEsterni:this.elencoCollaboratoriEnterno,
          progettisti:this.elencoAnagraficaProgettisti,
          successiviInterventiStraordinaria:this.elencoInterventiManutenzioneStraordinariaSCIACILAltro,
          TitoliAutorizzatiInterventiSuccessivi:this.elencoTitoliAutorizzatiInterventiSuccessivi,
          datiCatastali:this.elencoTitoliAutorizzatiDatiCatastali,
          centraleTermicaDiFAtto:this.elencoImpiantoAutonomoEsistente,
          centraleTermicaDiProgetto:this.elencoImpiantoAutonomoEsistenteStatoDiProgetto,
          
          tipoEdificioEF:this.edificioUnifamiliareTipo,
          propietariImmobiliEF:this.elencoProprietariImmobile,
          indirizzoEF:this.edificioUnifamiliareIndirizzo,
          cittaEF:this.edificioUnifamiliarecitta,
          provinciaEF:this.edificioUnifamiliareProvincia,
          annoCostruzioneEF:this.edificioUnifamiliareAnnocostruzione,
          indipendenteEF:this.screeningUnifamiliareIndipendente,
          accessoAutonomiEF:this.screeningUnifamiliareIAcessoAutonomo,
          usufruito110EF:this.screeningUnifamiliareUsufruito110,
          riqualificazioneBalconiEF:this.screeningUnifamiliareRiqualificazioneBalconi,

          nomeCondominioCD:this.condominioNome,
          indirizzoCD:this.condominioIndirizzo,
          cittaCD:this.condominioCitta,
          provinciaCD:this.condominioProvincia,
          annoCostruzioneCD:this.condominioAnnodicotruzione,
          pianoImmobileCD:this.condominioPianoimmboile,
          numeroUnitaAccatastateCD:this.condominioNumeroUnitaAccatastate,
          numeroUnitaScaldateCD:this.condominioNumerounitariscaldate,
          numeroPertinnzeAccatastateCD:this.condominioPertinenzaC2C6C7,
          condominioFormalmenteCostituitoCD:this.condominioformalmenteCostituito,
          condominioUnicoProprietarioCD:this.screeningCondominioUnicoProprietario,
          IRESCD:this.screeningCondominioSoggettiIRES,
          mutliProprietaCD:this.screeningCondominioPossiedonoMultiProprieta,
          condominioA1A8A9CD:this.screeningCondominioA1A8A9,
          usufruito110CD:this.screeningCondominioUsufruito110,
          cd_codicefiscale_condominio:this.condominioFormalmenteCostituitoCodiceFsicale,
          cd_info_condominiocostituito:this.condominioFormalmenteCostituitoRiferimentoAmministatore,

          elencoFile:this.elencoAllegati,


          };
          if (this.nuovoProgetto){
               Axios.post(this.linkApi+"/aggiungi-progetto",sendForm).then(Response=>{
            
            console.log(Response.data)
            if(Response.data.response=='ok'){
              this.messaggioDaVisualizzare='Progetto Caricato con successo';
              this.visualizzamessaggio=true;
            
              }else{
                 this.messaggioDaVisualizzare=Response.data.message;
              this.visualizzamessaggio=true;
              }
            });
          }
          if (!this.nuovoProgetto){
               Axios.post(this.linkApi+"/aggiorna-progetto/",sendForm).then(Response=>{
            
            console.log(Response.data)
            if(Response.data.response=='ok'){
              this.messaggioDaVisualizzare='Progetto Aggiornato con successo';
              this.visualizzamessaggio=true;
            
              }else{
                 this.messaggioDaVisualizzare=Response.data.message;
              this.visualizzamessaggio=true;
              }
            });
          }
       

      },
    addRow(){
       this.elencoAnagraficaClienti.push(
         {nome:this.modalNuovoNome,
          cognome:this.modalNuovoCognome,
           codiceFiscale:this.modalNuovoCodiceFiscale});
      this.modalNuovaAnagraficaClienti= false;
    },
    redirectlistaprogetti(){
this.$router.push({ path:'lista-progetti'});
    },
 
    handleFilePreventivo(e){
      this.nameAuxFilePreventivo=e.target.files[0].name;
      const selectImage= e.target.files[0];
      this.createBase64(selectImage);

    },

      createBase64Preventivo(fileObject){
      const reader = new FileReader();
      reader.onload = (e)=>{
       var aux= e.target.result;
       var base64string = window.btoa(aux);
       this.quoteAllegatoPreventivo=base64string;
      };
      this.quoteAllegatoPreventivo= reader.readAsBinaryString(fileObject);

//return output;
    },


    addrowDatiCatastaliTitoliAutorizzativi(){
      this.elencoTitoliAutorizzatiDatiCatastali.push(
        {sub:this.modalDatiCatastaliTitoliAutorizzativiNuovoSub,
         particella:this.modalDatiCatastaliTitoliAutorizzativiNuovoParticella,
         foglio:this.modalDatiCatastaliTitoliAutorizzativiNuovoFoglio});
         },

  /*  addrowImpiantoAutonomoProposto(){
      this.elencoImpiantoAutonomoProposto.push(
        {
            sub:this.NuovoImpiantoEsistenteAutonomosub,
            tecnologiaImpianto:this.NuovoImpiantoEsistenteAutonomotecnologiaImpianto,
            numeronUnitaGenerazione:this.NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione,
            tipologiaSistemaTermoregolazione:this.NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione,
            potenzaTermicaUtile:this.NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile,
            annoInstallazione:this.NuovoImpiantoEsistenteAutonomoannoInstallazione,
            GeneratoreOggettoDiSostituzione:this.NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione
            }
         
         );
        
      this.modalAggiungiImpiantoEsistenteAutonomoStatoProgetto= false;
    },*/
    addrowQuoteAcconti(){
      this.elencoQuote.push(
        {
          dataPagamento:this.dataAcconto,
          importo:this.quotaImportoAcconto,
          metodoPagamento:this.quotaAccontoModalitaPagamento.value,
          chiFatturato:this.quoteChiFattura,
          tipo_quota:'entrata'

        });
        },
    addrowQuoteSpese(){
      this.elencoSpese.push(
        {
          dataPagamento:this.dataSpesaEffettuata,
          importo:this.importoSpesaEffettuata,
          causale:this.causaleSpesaEffettuata,
          chiHapagato:this.chiHafattoSpesa,
          tipo_quota:'uscita'
        });
        },
    addrowAllegati(){
//TODO prevedere caricaemnto sul database diretto
this.elencoAllegati.push({
  nomeFile:this.nameAuxFile,
  fileBase64:this.auxFile,
  noteFile:this.noteallegatoDiallegati,
  tipoAllegato:this.tipoAllegatodiAllegati.value,
  idprogetto:0,
  new:1,
  cancellare:0,
  });

    },

    
    removeRow(index){
   this.elencoAnagraficaClienti.splice(index, 1)
    },
    elencoCercaUsersFunction(){
      if (this.CercaUtentiDaAutorizzare.length > 1){
      Axios.get(this.linkApi+'/getCercaUsersDaAutorizzare/'+this.idprogetto+'/'+this.CercaUtentiDaAutorizzare).then(Response=>{console.log(Response.data);this.elencoCercaUtentiDaAutorizzare= Response.data})
      }
      },
  
  

  autorizzaUtente(datiUtente){
    this.elencoUtentiDaAutorizzare.push({
        nome:datiUtente.name,
       email:datiUtente.email,
       ruolo:datiUtente.role,
       id:datiUtente.id,
      });
       this.CercaUtentiDaAutorizzare='';
       this.elencoCercaUtentiDaAutorizzare=null;
  },
 
 
    },
     
  data () {
    return {
     
      Progetto:{
        titoloProgetto:'',

        cercaAnagraficaClienti:'',
        elencoAnagraficaClienti:[],

        cercaCollaboratoriInterni:'',
        elencoCercaCollaboratoreInterno:'',
        elencoCollaboratoriInterno:'',

        cercaCollaboratoriEsterni:'',
        elencoCercaCollaboratoreEsterno:'',
        elencoCollaboratoriEnterno:[],
        //step2
        tipologiaEdificio:'',
        edificioUnifamiliareTipo:'',
        NuovoProprietarioImmobileNome:'',
        NuovoProprietarioImmobileCognome:'',
        NuovoProprietarioImmobileCodiceFiscale:'',
        NuovoProprietarioImmobileTelefono:'',
        elencoProprietariImmobile:[],
        
        edificioUnifamiliareIndirizzo:'',
        edificioUnifamiliarecitta:'',
        edificioUnifamiliareProvincia:'',
        edificioUnifamiliareAnnocostruzione:'',
        edificioUnifamiliarePianoImmobile:'',
        condominioNome:'',
        condominioIndirizzo:'',
        condominioCitta:'',
        condominioProvincia:'',
        condominioAnnodicotruzione:'',
        condominioPianoimmboile:'',
        condominioNumeroUnitaAccatastate:'',
        condominioNumerounitariscaldate:'',
        condominioPertinenzaC2C6C7:[],
        condominioformalmenteCostituito:'',
        condominioFormalmenteCostituitoCodiceFsicale:'',
        condominioFormalmenteCostituitoRiferimentoAmministatore:'',
        condominioNOformalmenteCostituitoReferente:'',
        condominioNOformalmenteCostituitoCodiceFiscaleReferente:'',
        zonaClimatica:[],
        gradigiornoText:'',
        areavincolata42:'',
        areaVicnolata42TipoVincolo:'',
        zonasismisca4:[],
        zonasismisca4Interventiantisismici:'',
        zonasismisca4InterventiantisismiciAltriVincoli:'',
        TipoInterventoProposto:[],
        TipologiainterventoDPR3802001:[],
        cercaProgettista:'',
        elencoCercaAnagraficaProgettisti:[],
        elencoAnagraficaProgettisti:[],
        screeningUnifamiliareIndipendente:'',
        screeningUnifamiliareIAcessoAutonomo:'',
        screeningUnifamiliareUsufruito110:'',
        screeningUnifamiliareRiqualificazioneBalconi:'',
        screeningCondominioUnicoProprietario:'',
        screeningCondominioSoggettiIRES:'',
        screeningCondominioPossiedonoMultiProprieta:'',
        screeningCondominioA1A8A9:'',
        screeningCondominioUsufruito110:'',
        tipologiaTitoloAutorizzativi:'',
        riferimentiAutorizzativi:'',
        dateAutorizzativi:'',
        data:'',
        AllegatoTitoloAutorizzativo:'',
        annoIntervento:'',
        elencoInterventiManutenzioneStraordinariaSCIACILAltro:[],
        modalInterventiSuccessiviNuovoSub:'',
        modalInterventiSuccessiviNuovaDecrizione:'',
        elencoTitoliAutorizzatiInterventiSuccessivi:[],
        modalDatiCatastaliTitoliAutorizzativiNuovoFoglio:'',
        modalDatiCatastaliTitoliAutorizzativiNuovoParticella:'',
        modalDatiCatastaliTitoliAutorizzativiNuovoSub:'',
        elencoTitoliAutorizzatiDatiCatastali:[],
        abusiEdilizi:'',
        TipologiaAbusiEdilizi:'',
        comuneStatoDiFatto:'',
        NCEUStatoDiFatto:'',
        difformitaUrbanistiche:'',
        noteDifformitaUrbanistiche:'',
        difformitaCatastali:'',
        noteDifformitaCatastali:'',
        irregolaritaSanabili:'',
        noteIrregolaritaSanabili:'',
        datistrutturalichk:[],
        altroDatiStrutturali:'',
        tipologiaParetechk:[],
        altroTipologiaParetechk:'',
        tipologia_doppia_parete:[],
        SpessoreMuriEsterni:'',
        SpessoreCameraDaria:'',
        SpessoreIsolamento:'',
        TipologiaIsolamentoIncameraDaria:'',
        isolamentoEsistentechk:[],
        altroisolamentoEsistentechk:'',
        tipologiaImpiantoEsistente:'',
        cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente:'',
        cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro:'',
        cetraleTermicaCentralizzatoNumeroUnita:'',
        cetraleTermicaCentralizzatoAnnoInstallazione:'',
        cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente:'',
        cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste:'',
        cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente:'',
        cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato:'',
        cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato:null,
        cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate:'',
        cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato:'',
        cetraleTermicaCentralizzatoCertificatoCPI:'',
        cetraleTermicaCentralizzatoCertificatoCPIAllegato:'',
        cetraleTermicaCentralizzatoTecnologiaImpiantoProposto:'',
        cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro:'',
        cetraleTermicaCentralizzatoNumeroUnitaProposte:'',
        cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto:'',
        centraleTermivaCentralizzatoVettoreImpianto:'',
        elencoImpiantoAutonomoEsistente:[],
        elencoImpiantoAutonomoEsistenteStatoDiProgetto:[],

      },
      pathAllegatoTitoloAutorizzativo:'',
      listaUsers:[],
        text:'',data:'',date:'',auxFile:null,nameAuxFile:'',nameAuxFilePreventivo:'',
        nuovoProgetto:true,
        CercaUtentiDaAutorizzare:'',
        cercaAnagraficaClienti:'',
        cercaCollaboratoriInterni:'',
        cercaCollaboratoriEsterni:'',
         tab: "progetto",
         modalNuovaAnagraficaClienti: false,
         modalNuovoNome:'',modalNuovoCognome:'',modalNuovoCodiceFiscale:'',
         
         screeningCondominioPossiedonoMultiProprieta:'',
         

         modalAggiungiAllegatiInterventiSuccessiviAllaCostruzione:false,
         modalInterventiSuccessiviNuovoSub:'',
         modalInterventiSuccessiviNuovaDecrizione:'',
         modalInterventiSuccessiviNuovoAllegato:null,

         modalDatiCatastaliTitoliAutorizzativi:false,
         modalDatiCatastaliTitoliAutorizzativiNuovoParticella:'',
         modalDatiCatastaliTitoliAutorizzativiNuovoSub:'',
         modalDatiCatastaliTitoliAutorizzativiNuovoFoglio:'',
        

         titoloProgetto:'',search:'',tipologiaEdificio:'',
         TipologiainterventoDPR3802001:[],
        /* TipologiainterventoDPR3802001Ordinaria:false,TipologiainterventoDPR3802001Straordinaria:false,TipologiainterventoDPR3802001RisanamentoConcervativo:false,TipologiainterventoDPR3802001RistrutturazioneEdilizia:false,TipologiainterventoDPR3802001NuovaCostruzione:false,TipologiainterventoDPR3802001InterventiUrbanistici:false,*/
         zonaClimatica:[],
        /* zonaclimaticaA:false,zonaclimaticaB:false,zonaclimaticaC:false,zonaclimaticaD:false,zonaclimaticaE:false,zonaclimaticaF:false,*/
         
         gradigiornoText:'',areavincolata42:'',
         areaVicnolata42TipoVincolo:'',zonasismisca4:'',zonasismisca4Interventiantisismici:'',zonasismisca4InterventiantisismiciAltriVincoli:'',edificioUnifamiliareTipo:false,edificioUnifamiliareIndirizzo:'',
         allegatoIntervento:null,annoIntervento:'',
         edificioUnifamiliarecitta:'', edificioUnifamiliareProvincia:'', edificioUnifamiliareAnnocostruzione:'',
         edificioUnifamiliarePianoImmobile:' di cui fuori terra n° ',edificioUnifamiliareTipologiaIntervento:false,
         condominioNome:'',condominioIndirizzo:'',condominioCitta:'',condominioProvincia:'',
         condominioAnnodicotruzione:'',condominioPianoimmboile:'',condominioPertinenzaC2C6C7:[],
         condominioformalmenteCostituito:false,condominioFormalmenteCostituitoCodiceFsicale:'',condominioFormalmenteCostituitoRiferimentoAmministatore:'',
         condominioNOformalmenteCostituitoReferente:'',condominioNOformalmenteCostituitoCodiceFiscaleReferente:'',
         dateAutorizzativi:'',	riferimentiAutorizzativi:'',			tipologiaTitoloAutorizzativi:'',
         AllegatoTitoloAutorizzativo:'', 
         Base64AllegatoTitoloAutorizzativo:'',
         
         
         TipoInterventoProposto:[],
         /*TipoInterventoPropostoEnergetico:false,TipoInterventoPropostoSismico:false,TipoInterventoPropostoCombinato:false,*/
         
         condominioNumeroUnitaAccatastate:'',condominioNumerounitariscaldate:'',cercaProgettista:'',screeningUnifamiliareIndipendente:'',screeningUnifamiliareIAcessoAutonomo:'',
         screeningUnifamiliareRiqualificazioneBalconi:'',screeningUnifamiliareUsufruito110:'',
         screeningCondominioUnicoProprietario:'',screeningCondominioSoggettiIRES:'',PossiedonoMultiProprieta:'',screeningCondominioUsufruito110:'',screeningCondominioA1A8A9:'', 
          
          files: null,
          abusiEdilizi:false,TipologiaAbusiEdilizi:'',comuneStatoDiFatto:false,NCEUStatoDiFatto:false,difformitaUrbanistiche:false,difformitaCatastali:false,irregolaritaSanabili:false,
          noteDifformitaUrbanistiche:'',noteDifformitaCatastali:'',noteIrregolaritaSanabili:'',

          datistrutturalichk:[],altroDatiStrutturali:'',
          tipologiaParetechk:[],altroTipologiaParetechk:'',
          tipologia_doppia_parete:[],
          SpessoreMuriEsterni:'',SpessoreCameraDaria:'',SpessoreIsolamento:'',TipologiaIsolamentoIncameraDaria:'',
          isolamentoEsistentechk:[],altroisolamentoEsistentechk:'',

          tipologiaImpiantoEsistente:'',

          cetraleTermicaCentralizzatoNumeroUnita:'', cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente:'', cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro:'', cetraleTermicaCentralizzatoAnnoInstallazione:'',cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato:null,
          cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente:'', cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste:'', cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente:'',
          cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato:'', cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate:'', cetraleTermicaCentralizzatoCertificatoCPI:'',
          cetraleTermicaCentralizzatoCertificatoCPIAllegato:null,cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato:null,
          
          cetraleTermicaCentralizzatoTecnologiaImpiantoProposto:'',cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro:'', cetraleTermicaCentralizzatoNumeroUnitaProposte:'', centraleTermivaCentralizzatoVettoreImpianto:'',cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto:'',


          modalAggiungiImpiantoEsistenteAutonomo:false,  modalAggiungiImpiantoEsistenteAutonomoStatoProgetto:false,visualizzamessaggio:false,messaggioDaVisualizzare:'',
          NuovoImpiantoEsistenteAutonomosub:'', NuovoImpiantoEsistenteAutonomotecnologiaImpianto:'',NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione:'',NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione:'',
          NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile:'',NuovoImpiantoEsistenteAutonomoannoInstallazione:'',NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione:'',
          allegatoDiAllegati:null,tipoAllegatodiAllegati:'',noteallegatoDiallegati:'',

          quotaPreventivo:'', quoteAllegatoPreventivo:null,
          dataAcconto:'',quotaAccontoModalitaPagamento:'',quotaImportoAcconto:'',quoteChiFattura:'',

          dataSpesaEffettuata:'',importoSpesaEffettuata:'', causaleSpesaEffettuata:'', chiHafattoSpesa:'',
          elencoProprietariImmobile:[],NuovoProprietarioImmobileNome:'',NuovoProprietarioImmobileCognome:'',NuovoProprietarioImmobileCodiceFiscale:'',NuovoProprietarioImmobileTelefono:'',
       tipoAltroAllegato:'',
      columns: [
        { name: 'id', align: 'center', label: 'ID', field: 'id', sortable: true },
        { name: 'nome', required: true, label: 'Nome', align: 'left', field: row => row.nome, format: val => `${val}`,sortable: true},
        { name: 'cognome', align: 'center', label: 'Cognome', field: 'cognome', sortable: true },
        { name: 'codiceFiscale', label: 'Codice Fiscale', field: 'codiceFiscale', sortable: true },
        { name: 'ragionesociale', label:'Ragione sociale', field:'ragionesociale'}
       
       
           ],

      elencoCercaUtentiDaAutorizzare: [],
      elencoCercaAnagraficaClienti: [],
      elencoCercaCollaboratoreEsterno: [],
      elencoCercaCollaboratoreInterno: [],
      elencoCercaAnagraficaProgettisti: [],

      elencoUtentiDaAutorizzare: [],
      elencoUtentiAutorizzati: [],
      elencoAnagraficaClienti: [],
      elencoCollaboratoriEnterno: [],
      elencoCollaboratoriInterno: [],
      elencoAnagraficaProgettisti: [],
      elencoInterventiManutenzioneStraordinariaSCIACILAltro:[],
      elencoTitoliAutorizzatiInterventiSuccessivi:[],
      elencoTitoliAutorizzatiDatiCatastali:[],
      elencoImpiantoAutonomoEsistente:[],
      elencoImpiantoAutonomoEsistenteStatoDiProgetto:[],
      elencoImpiantoAutonomoProposto:[],
      
      elencoAllegati:[],
     elencoMetodoPagamenti:[
       {value:'c/c',label:'Conto corrente'},
       {value:'carta',label:'Carta'},
       {value:'carta2',label:'Carta C'}
       
       ],
     tipiDiAllegati:[
        {
        value:'ModelloPrivacy',
        label:'Modello privacy',
        },
        {
        value:'Visure',
        label:'Visure',
        },
        {
        value:'TitoloProvenienza',
        label:'Titolo di provenienza',
        },
        {
        value:'DocumentiIdentita',
        label:'Documenti di identità',
        },
        {
        value:'ConcessioneEdilizia',
        label:'Concessione edilizia',
        },
        {
        value:'Agibilita',
        label:'Agibilità',
        },
        {
        value:'PermessoCostruire',
        label:'Permesso di Costruire',
        },
        {
        value:'Cila',
        label:'Cila',
        },
        {
        value:'Cil',
        label:'Cil',
        },
        {
        value:'AgibilitaAbitabilita',
        label:'Agibilità abitabilità',
        },
        {
        value:'SCA',
        label:'SCA',
        },
        {
        value:'SCIA',
        label:'SCIA',
        },
        {
        value:'DIA',
        label:'DIA',
        },
        {
        value:'CertificazioniVarie',
        label:'Certificazioni varie',
        },
        {
        value:'DocumentiStrutture',
        label:'Documenti Strutture',
        },
        {
        value:'DocumentiImpianti',
        label:'Documenti Impianti',
        },
        {
        value:'PareriVariEnti',
        label:'Pareri vari enti',
        },
        {
        value:'APE',
        label:'APE',
        },
        {
        value:'Contratto',
        label:'Contratto',
        },
        {
        value:'altro',
        label:'Altro',
        },
       
        
      ],
      //deve essere uguale a quello di back-end
      staticTipoAllegato:{
        preventivoFirmato:'preventivoFirmato'

      },
      elencoQuote:[],
      elencoSpese:[]
    }
  },

  components: {
     
    /*formNuovaanagrafica, message,*/step1,step2,step3,step4,
  },
 
  props:['idprogetto'],

  beforeMount:function(){


   if (this.idprogetto >0){ 
/********** DETTAGLI PROGETTO **********/

    this.nuovoProgetto=false;
Axios.get(this.linkApi+'/getProgetto/'+this.idprogetto).then(response =>{
//TODO PROBLEMA ALLEGATO
/* LISTA CLIENTI */
if (response.data['clienti'][0] != null){

 response.data['clienti'].forEach(element => {
   this.elencoAnagraficaClienti.push({
     nome:element.nome,
     cognome:element.cognome,
     codiceFiscale:element.codice_fiscale,
     denominazione:element.denominazione,
     partitaIva:element.partita_iva,
     id:element.id,
     
     });
   });
}
if (response.data['collaboratoriEsterni'][0] != null){

 response.data['collaboratoriEsterni'].forEach(element => {
   this.elencoCollaboratoriEnterno.push({
     nome:element.nome,
     cognome:element.cognome,
     codiceFiscale:element.codice_fiscale,
     denominazione:element.denominazione,
     partitaIva:element.partita_iva,
     id:element.id,
     });
   });
}
if (response.data['collaboratoriInterni'][0] != null){

 response.data['collaboratoriInterni'].forEach(element => {
   this.elencoCollaboratoriInterno.push({
     nome:element.nome,
     cognome:element.cognome,
     codiceFiscale:element.codice_fiscale,
     denominazione:element.denominazione,
     partitaIva:element.partita_iva,
     id:element.id,
     
        });
   });
}
if (response.data['progettistiProgetto'][0] != null){

 response.data['progettistiProgetto'].forEach(element => {
   this.elencoAnagraficaProgettisti.push({
     nome:element.nome,
     cognome:element.cognome,
     codiceFiscale:element.codice_fiscale,
      });
   });
}
if (response.data['interventiSuccessivi'][0] != null){

 response.data['interventiSuccessivi'].forEach(element => {
   this.elencoInterventiManutenzioneStraordinariaSCIACILAltro.push({
     id:element.id,
     id_legame:element.id_legame,
     id_progetto:element.id_progetto,
     anno:element.anno_intervento,
     allegato:element.nome_file,
     allegatoBase64:0,
     new:0,
     cancellare:0,
      });
   });
}
if (response.data['titoliAutorizzativiInterventiSuccessici'][0] != null){

 response.data['titoliAutorizzativiInterventiSuccessici'].forEach(element => {
   this.elencoTitoliAutorizzatiInterventiSuccessivi.push({
     sub:element.sub,
     descrizione:element.descrizione, 
     nomeAllegato:element.nome_file,
      allegatoBase64:0,
      new:0,
      cancellare:0
      });
   });
}
if (response.data['dataCatastali'][0] != null){

 response.data['dataCatastali'].forEach(element => {
   this.elencoTitoliAutorizzatiDatiCatastali.push({
     sub:element.sub,
     foglio:element.foglio, 
     particella:element.particella,
    });
   });
}
if (response.data['impiantoAutonomoDiFatto'][0] != null){

 response.data['impiantoAutonomoDiFatto'].forEach(element => {
   this.elencoImpiantoAutonomoEsistente.push({
     sub:element.sub,
     tecnologiaImpianto:element.tecnologia_impianto, 
     numeronUnitaGenerazione:element.numero_unita,
     tipologiaSistemaTermoregolazione:element.tipo_termoregolazione,
     potenzaTermicaUtile:element.potenza_kw,
     annoInstallazione:element.anno_installazione,
     GeneratoreOggettoDiSostituzione:element.oggetto_di_sostituzione,
     nuovo:0
     
     });
   });
}
if (response.data['impiantoAutonomoDiProgetto'][0] != null){

 response.data['impiantoAutonomoDiProgetto'].forEach(element => {
   this.elencoImpiantoAutonomoEsistenteStatoDiProgetto.push({
     sub:element.sub,
     tecnologiaImpianto:element.tecnologia_impianto, 
     numeronUnitaGenerazione:element.numero_unita,
     tipologiaSistemaTermoregolazione:element.tipo_termoregolazione,
     potenzaTermicaUtile:element.potenza_kw,
     annoInstallazione:element.anno_installazione,
     GeneratoreOggettoDiSostituzione:element.oggetto_di_sostituzione,
     nuovo:0
     });
   });
}
if (response.data['allegatiProgetto'][0] != null){

 response.data['allegatiProgetto'].forEach(element => {
   this.elencoAllegati.push({
     id:element.id,
     nomeFile:element.nome_file,
     noteFile:element.note_allegato, 
     tipoAllegato:element.tipo_allegato,
     idprogetto:element.id_progetto,
     new:0,
     cancellare:0,
     });
     if (element.tipo_allegato == this.staticTipoAllegato.preventivoFirmato){
     
     this.quoteAllegatoPreventivo=element.nome_file;
     }
   });
}
if (response.data['quoteAcconti'][0] != null){

 response.data['quoteAcconti'].forEach(element => {
   this.elencoQuote.push({
     dataPagamento:element.data,
     importo:element.importo, 
     metodoPagamento:element.modalita_pagamento,
     chiFatturato:element.chi_ha_fatturata,
     tipo_quota:element.tipo_quota,
   
     });
   });
}
if (response.data['quoteSpese'][0] != null){

 response.data['quoteSpese'].forEach(element => {
   this.elencoSpese.push({
     dataPagamento:element.data,
     importo:element.importo, 
     causale:element.modalita_pagamento,
     chiHapagato:element.chi_ha_fatturata,
     tipo_quota:element.tipo_quota,
     
     });
   });
}
if (response.data['listaUsersAssociatiAlProgetto'][0] != null){

 response.data['listaUsersAssociatiAlProgetto'].forEach(element => {
   this.elencoUtentiAutorizzati.push({
     nome:element.name,
     email:element.email, 
     ruolo:element.role,
     id:element.id_user,
     idRiga:element.id
     });
 
   });
}

if (response.data['infoEdificioProgetto'][0]!= null){
var dettagliEdificio=response.data['infoEdificioProgetto'][0];
this.edificioUnifamiliareTipo=dettagliEdificio.ef_tipo_edificio;
/* CONDOMINIO */
this.condominioNome=dettagliEdificio.cd_nome_condominio;
this.condominioIndirizzo=dettagliEdificio.cd_indirizzo;
this.condominioCitta=dettagliEdificio.cd_citta;
this.condominioProvincia=dettagliEdificio.cd_citta;
this.condominioAnnodicotruzione=dettagliEdificio.cd_annocostruzione;
this.condominioPianoimmboile=dettagliEdificio.cd_piano_immobile;
this.condominioNumeroUnitaAccatastate=dettagliEdificio.cd_numero_ui_accatastate;
this.condominioNumerounitariscaldate= dettagliEdificio.cd_numero_ui_riscaldate;
if (dettagliEdificio.cd_numero_pertinnze_accatastate != null){
var outputsplit = dettagliEdificio.cd_numero_pertinnze_accatastate.split(';');
if (outputsplit!=null){
   outputsplit.forEach(element=>{this.condominioPertinenzaC2C6C7.push(element)});
}}
this.condominioformalmenteCostituito=dettagliEdificio.cd_condominio_costituito;
if(dettagliEdificio.cd_condominio_costituito=='SI'){
this.condominioFormalmenteCostituitoCodiceFsicale=dettagliEdificio.cd_codicefiscale_condominio;
this.condominioFormalmenteCostituitoRiferimentoAmministatore=dettagliEdificio.cd_info_condominiocostituito;}
if(dettagliEdificio.cd_condominio_costituito=='NO'){
this.condominioNOformalmenteCostituitoCodiceFiscaleReferente=dettagliEdificio.cd_codicefiscale_condominio;
this.condominioNOformalmenteCostituitoReferente=dettagliEdificio.cd_info_condominiocostituito;}
/* SCREENIN CONDOMINIO */
this.screeningCondominioUnicoProprietario=dettagliEdificio.cd_unico_proprietario ;
this.screeningCondominioSoggettiIRES=dettagliEdificio.cd_ires;
this.screeningCondominioPossiedonoMultiProprieta=dettagliEdificio.cd_condomini_altri_unita;
this.screeningCondominioA1A8A9=dettagliEdificio.cd_a1a8a9;
this.screeningCondominioUsufruito110= dettagliEdificio.cd_usufruito110;


/*FINE CONDOMINIO */



/* familiare */
if (response.data['infoelencoProprietariImmobile'][0] != null){
  var listaProprietari=response.data['infoelencoProprietariImmobile'];
listaProprietari.forEach(element =>{ this.elencoProprietariImmobile.push(
         {nome:element.nome, 
         cognome:element.cognome,
        codiceFiscale:element.codicefiscale,
        telefono:element.telefono,
          });});
}
this.edificioUnifamiliareTipo=dettagliEdificio.ef_tipo_edificio;
this.edificioUnifamiliareIndirizzo=dettagliEdificio.ef_indirizzo;
this.edificioUnifamiliarecitta=dettagliEdificio.ef_citta;
this.edificioUnifamiliareProvincia=dettagliEdificio.ef_provincia;
this.edificioUnifamiliareAnnocostruzione=dettagliEdificio.ef_annocostruzione;
this.edificioUnifamiliarePianoImmobile=dettagliEdificio.ef_pianoImmobili;

/*screening familiare */
this.screeningUnifamiliareIndipendente=dettagliEdificio.ef_indipendente;
this.screeningUnifamiliareIAcessoAutonomo=dettagliEdificio.ef_accesso_autonomo;
this.screeningUnifamiliareUsufruito110=dettagliEdificio.ef_usufruito_110;
this.screeningUnifamiliareRiqualificazioneBalconi=dettagliEdificio.ef_riqualificazioni_balconi;



/* familiare */


}


/*DATI GENERICI PROGETTO */
  this.titoloProgetto=response.data['progetto'][0].titolo_progetto;
 this.tipologiaEdificio = response.data['progetto'][0].tipologia_edificio;

    outputsplit= response.data['progetto'][0].zona_climatica.split(";");
   if (outputsplit!= null){
  outputsplit.forEach(element => {this.zonaClimatica.push(element); });}
  //this.zonaClimatica = response.data['progetto'][0].zona_climatica;
  this.gradigiornoText = response.data['progetto'][0].gradi_giorno ;
  this.areavincolata42 = response.data['progetto'][0].areavincolata; 
  this.areaVicnolata42TipoVincolo = response.data['progetto'][0].tipo_vincolo; 
  this.zonasismisca4 = response.data['progetto'][0].zonasismisca ;
  this.zonasismisca4Interventiantisismici = response.data['progetto'][0].interventi_antisismici ;
  this.zonasismisca4InterventiantisismiciAltriVincoli = response.data['progetto'][0].interventi_sismici_altri_vincoli ;
  if (response.data['progetto'][0].TipoInterventoProposto != null){
  outputsplit= response.data['progetto'][0].TipoInterventoProposto.split(";");
  if (outputsplit!= null){
  outputsplit.forEach(element => {this.TipoInterventoProposto.push(element); });}}
if (response.data['progetto'][0].TipologiainterventoDPR3802001 != null){
  outputsplit= response.data['progetto'][0].TipologiainterventoDPR3802001.split(";");
  if (outputsplit != null){
   outputsplit.forEach(element => {this.TipologiainterventoDPR3802001.push(element); });
  }
  }
  this.tipologiaTitoloAutorizzativi= response.data['progetto'][0].tipologiaTitoloAutorizzativi;
  this.riferimentiAutorizzativi= response.data['progetto'][0].riferimentiAutorizzativi;
  this.dateAutorizzativi= response.data['progetto'][0].dateAutorizzativi;
  this.AllegatoTitoloAutorizzativo=response.data['progetto'][0].AllegatoTitoloAutorizzativo;
  this.pathAllegatoTitoloAutorizzativo= this.linkApi+'/'+this.idprogetto+'/'+this.AllegatoTitoloAutorizzativo;
  this.abusiEdilizi= response.data['progetto'][0].abusiEdilizi;
  this.TipologiaAbusiEdilizi = response.data['progetto'][0].TipologiaAbusiEdilizi;
  this.comuneStatoDiFatto = response.data['progetto'][0].comuneStatoDiFatto;
  this.NCEUStatoDiFatto = response.data['progetto'][0].NCEUStatoDiFatto;
  this.difformitaUrbanistiche = response.data['progetto'][0].difformitaUrbanistiche;
  this.noteDifformitaUrbanistiche = response.data['progetto'][0].noteDifformitaUrbanistiche;
  this.difformitaCatastali = response.data['progetto'][0].difformitaCatastali;
  this.noteDifformitaCatastali= response.data['progetto'][0].noteDifformitaCatastali;
  this.irregolaritaSanabili= response.data['progetto'][0].irregolaritaSanabili;
  this.noteIrregolaritaSanabili= response.data['progetto'][0].noteIrregolaritaSanabili;

  if (response.data['progetto'][0].tipologia_struttura_edificiio != null){
   outputsplit= response.data['progetto'][0].tipologia_struttura_edificiio.split(";");
  
   outputsplit.forEach(element => {this.datistrutturalichk.push(element); });
  }
  this.altroDatiStrutturali = response.data['progetto'][0].altroDatiStrutturali;
  
  if (response.data['progetto'][0].tipologia_parete != null){
   outputsplit= response.data['progetto'][0].tipologia_parete.split(";");
   outputsplit.forEach(element => {this.tipologiaParetechk.push(element); });
  }

  this.altroTipologiaParetechk = response.data['progetto'][0].altroTipologiaParetechk;
 if ( response.data['progetto'][0].tipologia_doppia_parete  != null){
   outputsplit= response.data['progetto'][0].tipologia_doppia_parete.split(";");
   outputsplit.forEach(element => {this.tipologia_doppia_parete.push(element); });
  }
  this.SpessoreMuriEsterni = response.data['progetto'][0].spessori_muri_esternicm;
  this.SpessoreCameraDaria = response.data['progetto'][0].spessori_camera_ariacm;
  this.SpessoreIsolamento = response.data['progetto'][0].spessore_isolamentocm;
  this.TipologiaIsolamentoIncameraDaria = response.data['progetto'][0].tipo_isolamento_camera_aria;
  if (response.data['progetto'][0].cappotto != null){
  outputsplit= response.data['progetto'][0].cappotto.split(";");
  
   outputsplit.forEach(element => {this.isolamentoEsistentechk.push(element); });
  }
  this.altroisolamentoEsistentechk= response.data['progetto'][0].altroisolamentoEsistente;
  this.tipologiaImpiantoEsistente = response.data['progetto'][0].centraletermicaesistente_tipo_impianto;
  /* centrale termina centralizzato */

  this.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente= response.data['progetto'][0].centraletermicaesistente_tecnologia_impianto;
  this.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro= response.data['progetto'][0].cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro;
  this.cetraleTermicaCentralizzatoNumeroUnita= response.data['progetto'][0].centraletermicaesistente_numero_unita_generazione;
  this.cetraleTermicaCentralizzatoAnnoInstallazione= response.data['progetto'][0].centraletermicaesistente_anno_installazione;
  this.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente= response.data['progetto'][0].centraletermicaesistente_potenza_termica;
  this.cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste= response.data['progetto'][0].centraletermicaesistente_tipologia_distribuzione;
  this.cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente= response.data['progetto'][0].centraletermicaesistente_tipologia_termoregolazione;
  this.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato=response.data['progetto'][0].centraletermicaesistente_libretto_impianto_aggiornato;
  this.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate= response.data['progetto'][0].centraletermicaesistente_provefumi;
  this.cetraleTermicaCentralizzatoCertificatoCPI=response.data['progetto'][0].centraletermicaesistente_cpi;
  this.cetraleTermicaCentralizzatoTecnologiaImpiantoProposto=response.data['progetto'][0].centraletermicaprogetto_tecnologia_esistente;
  this.cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro=response.data['progetto'][0].centraletermicaprogetto_tecnologia_esistente_altro;
  this.cetraleTermicaCentralizzatoNumeroUnitaProposte=response.data['progetto'][0].centraletermicaprogetto_numero_unita;
  this.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto=response.data['progetto'][0].centraletermicaprogetto_potenza_termica;
  this.centraleTermivaCentralizzatoVettoreImpianto=response.data['progetto'][0].centraletermicaprogetto_vettore_energetico;
  this.quotaImportoAcconto= response.data['progetto'][0].quota_preventivo;
  
})

  }else{
    this.nuovoProgetto=true;
  }
  }

}
</script>