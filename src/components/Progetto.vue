

<template>
<!--q-pa-md-->
<div   class=" text-grey row" style="background-color:#f2f4f8; " >
  
  <q-tabs  v-model="tab" inline-label dense style="background-color:#fdfdfd; " class=" shadow-2 col-12"  :breakpoint="200">
   <!--   <q-tab name="progetto" icon="home_work"  label="Progetto"  />
      <q-tab name="anagraficaIntervento"  icon="alarm" label="Anagrafica intervento" /> 
      <q-tab name="screening"  icon="movie" label="Screening" />
      <q-tab name="datiStrutturali"  icon="build" label="Dati Strutturali" />
      <q-tab name="allegati"  icon="attach_file" label="Allegati" />
      <q-tab  v-if="user.role=='admin'" name="quote"  icon="euro_symbol" label="Quote" />
      <q-tab v-if="user.role=='admin'" name="associaUtenti"  icon="engineering" label="Permessi" />
      <q-tab v-if="user.role=='admin'" name="wbs"  icon="engineering" label="WBS" /> -->
       <q-tab name="progetto" label="Progetto"  />
      <q-tab name="anagraficaIntervento"   label="Anagrafica intervento" /> 
      <q-tab name="screening" label="Screening" />
      <q-tab name="datiStrutturali" label="Dati Strutturali" />
      <q-tab name="allegati"   label="Allegati" />
      <q-tab  v-if="user.role=='admin'" name="quote"  label="Quote" />
      <q-tab v-if="user.role=='admin'" name="associaUtenti"  label="Permessi" />
      <q-tab v-if="user.role=='admin'" name="wbs"  label="WBS" /> 
     <q-btn color="secondary" v-if="!nuovoProgetto" icon="save" label="Save" @click="aggiungiProgetto()" />
     <q-btn color="primary" v-if="nuovoProgetto" label="Crea progetto" @click="aggiungiProgetto()" />
    </q-tabs> 

 <div v-if="tab == 'progetto'" class=" col-12" >
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

  <div v-if="tab=='allegati'" style="color:grey; background-color: white;" class=" col-12">
    <step5 v-model="Progetto" ></step5>
  </div>
  <div v-if="tab=='quote'" style="color:grey; background-color: white;" class=" col-12">
    <step6 v-model="Progetto" ></step6>
  </div>
<div v-if="tab == 'associaUtenti'" style="color:grey; background-color: white;" class=" col-12">
<autorizzaUtenti v-model="Progetto"></autorizzaUtenti>

</div>
  <div v-if="tab=='wbs'" style="color:grey">
    <wbs  v-model="Progetto"></wbs>
  </div>
  

<!-- #region Associa Utenti-->
<div v-if="tab == 'associaUtenti'" style="color:grey; background-color: white;" class=" col-12">
<autorizzaUtenti v-model="Progetto"></autorizzaUtenti>

</div>
<!-- #endregion-->





<!-- #region MODAL-->
<!-- MODAL -->
<!--
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
-->





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
.q-tab__label {
   font-size: 8px !important; 
}
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
import {mapGetters} from 'vuex'
import step1 from '@/components/step1Progetto.vue';
import step2 from '@/components/step2AnagraficaIntervento.vue';
import step3 from '@/components/step3Screening.vue';
import step4 from '@/components/step4DatiStrutturali.vue';
import step5 from '@/components/step5Allegati.vue';
import step6 from '@/components/step6Quote.vue';
import autorizzaUtenti from '@/components/autorizzaUtenti.vue';
import wbs from '@/components/wbs.vue';

export default {


    methods: {
      checkboxValue: function(params) {
      this.check = params;
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

        idprogetto:this.Progetto.idprogetto,
        numeroCommessa:this.Progetto.numeroCommessa,
        tipoCommessa:this.Progetto.tipoCommessa,
          titoloProgetto:this.Progetto.titoloProgetto,
         tipologiaEdificio:this.Progetto.tipologiaEdificio,
         zonaClimatica:this.Progetto.zonaClimatica,
         gradigiornoText:this.Progetto.gradigiornoText ,
          areavincolata42:this.Progetto.areavincolata42 ,
          tipoVincolo42:this.Progetto.areaVicnolata42TipoVincolo,
          zonasismisca4:this.Progetto.zonasismisca4 ,
          zonasismisca4Interventiantisismici:this.Progetto.zonasismisca4Interventiantisismici ,
          zonasismisca4InterventiantisismiciAltriVincoli:this.Progetto.zonasismisca4InterventiantisismiciAltriVincoli ,
          TipoInterventoProposto:this.Progetto.TipoInterventoProposto ,
          TipologiainterventoDPR3802001:this.Progetto.TipologiainterventoDPR3802001 ,

          tipologiaTitoloAutorizzativi:this.Progetto.tipologiaTitoloAutorizzativi ,
          riferimentiAutorizzativi:this.Progetto.riferimentiAutorizzativi,
          dateAutorizzativi:this.Progetto.dateAutorizzativi,
          AllegatoTitoloAutorizzativo:this.Progetto.AllegatoTitoloAutorizzativo,
          Base64AllegatoTitoloAutorizzativo:this.Progetto.Base64AllegatoTitoloAutorizzativo,

          abusiEdilizi:this.Progetto.abusiEdilizi,
          TipologiaAbusiEdilizi:this.Progetto.TipologiaAbusiEdilizi,
          comuneStatoDiFatto:this.Progetto.comuneStatoDiFatto,
          NCEUStatoDiFatto:this.Progetto.NCEUStatoDiFatto,
          difformitaUrbanistiche:this.Progetto.difformitaUrbanistiche,
          noteDifformitaUrbanistiche:this.Progetto.noteDifformitaUrbanistiche,
          difformitaCatastali:this.Progetto.difformitaCatastali,
          noteDifformitaCatastali:this.Progetto.noteDifformitaCatastali,
          irregolaritaSanabili:this.Progetto.irregolaritaSanabili,
          noteIrregolaritaSanabili:this.Progetto.noteIrregolaritaSanabili,

          datistrutturalichk:this.Progetto.datistrutturalichk,
          altroDatiStrutturali:this.Progetto.altroDatiStrutturali,

          tipologiaParetechk:this.Progetto.tipologiaParetechk,
          altroTipologiaParetechk:this.Progetto.altroTipologiaParetechk,

          tipologia_doppia_parete:this.Progetto.tipologia_doppia_parete,
          SpessoreMuriEsterni:this.Progetto.SpessoreMuriEsterni,
          SpessoreCameraDaria:this.Progetto.SpessoreCameraDaria,
          SpessoreIsolamento:this.Progetto.SpessoreIsolamento,
          TipologiaIsolamentoIncameraDaria:this.Progetto.TipologiaIsolamentoIncameraDaria,
          isolamentoEsistentechk:this.Progetto.isolamentoEsistentechk,
          altroisolamentoEsistentechk:this.Progetto.altroisolamentoEsistentechk,

          tipologiaImpiantoEsistente:this.Progetto.tipologiaImpiantoEsistente,
          cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente:this.Progetto.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente.value,
          cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro:this.Progetto.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro,
          cetraleTermicaCentralizzatoNumeroUnita:this.Progetto.cetraleTermicaCentralizzatoNumeroUnita,
          cetraleTermicaCentralizzatoAnnoInstallazione:this.Progetto.cetraleTermicaCentralizzatoAnnoInstallazione ,
          cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente:this.Progetto.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente ,
          cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste:this.Progetto.cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste ,
          cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente:this.Progetto.cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente,
          cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato:this.Progetto.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato ,
          cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato:this.Progetto.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato ,
          cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate:this.Progetto.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate ,
          cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato:this.Progetto.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato ,
          cetraleTermicaCentralizzatoCertificatoCPI:this.Progetto.cetraleTermicaCentralizzatoCertificatoCPI ,
          cetraleTermicaCentralizzatoCertificatoCPIAllegato:this.Progetto.cetraleTermicaCentralizzatoCertificatoCPIAllegato ,
          cetraleTermicaCentralizzatoTecnologiaImpiantoProposto:this.Progetto.cetraleTermicaCentralizzatoTecnologiaImpiantoProposto.value ,
          cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro:this.Progetto.cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro ,
          cetraleTermicaCentralizzatoNumeroUnitaProposte:this.Progetto.cetraleTermicaCentralizzatoNumeroUnitaProposte ,
          cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto:this.Progetto.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto ,
          centraleTermivaCentralizzatoVettoreImpianto:this.Progetto.centraleTermivaCentralizzatoVettoreImpianto ,
          quotaPreventivo:this.Progetto.quotaPreventivo,

          quoteAllegatoPreventivo:this.Progetto.nameAuxFilePreventivo,
          base64AllegatoPreventivo:this.Progetto.base64AllegatoPreventivo,
          elencoAcconti:this.Progetto.elencoQuote,
          elencoSpese:this.Progetto.elencoSpese,

          clienti:this.Progetto.elencoAnagraficaClienti,
          collaboratoriInterni:this.Progetto.elencoCollaboratoriInterno,
          collaboratoriEsterni:this.Progetto.elencoCollaboratoriEnterno,
          progettisti:this.Progetto.elencoAnagraficaProgettisti,
          successiviInterventiStraordinaria:this.Progetto.elencoInterventiManutenzioneStraordinariaSCIACILAltro,
          TitoliAutorizzatiInterventiSuccessivi:this.Progetto.elencoTitoliAutorizzatiInterventiSuccessivi,
          datiCatastali:this.Progetto.elencoTitoliAutorizzatiDatiCatastali,
          centraleTermicaDiFAtto:this.Progetto.elencoImpiantoAutonomoEsistente,
          centraleTermicaDiProgetto:this.Progetto.elencoImpiantoAutonomoEsistenteStatoDiProgetto,
          
          tipoEdificioEF:this.Progetto.edificioUnifamiliareTipo,
          altroTipoEdificioFamiliare:this.Progetto.altroTipoEdificioFamiliare,
          propietariImmobiliEF:this.Progetto.elencoProprietariImmobile,
          indirizzoEF:this.Progetto.edificioUnifamiliareIndirizzo,
          cittaEF:this.Progetto.edificioUnifamiliarecitta,
          provinciaEF:this.Progetto.edificioUnifamiliareProvincia,
          annoCostruzioneEF:this.Progetto.edificioUnifamiliareAnnocostruzione,
          pianoImmobileEF:this.Progetto.edificioUnifamiliarePianoImmobile,
          indipendenteEF:this.Progetto.screeningUnifamiliareIndipendente,
          accessoAutonomiEF:this.Progetto.screeningUnifamiliareIAcessoAutonomo,
          usufruito110EF:this.Progetto.screeningUnifamiliareUsufruito110,
          riqualificazioneBalconiEF:this.Progetto.screeningUnifamiliareRiqualificazioneBalconi,

          nomeCondominioCD:this.Progetto.condominioNome,
          indirizzoCD:this.Progetto.condominioIndirizzo,
          cittaCD:this.Progetto.condominioCitta,
          provinciaCD:this.Progetto.condominioProvincia,
          annoCostruzioneCD:this.Progetto.condominioAnnodicotruzione,
          pianoImmobileCD:this.Progetto.condominioPianoimmboile,
          numeroUnitaAccatastateCD:this.Progetto.condominioNumeroUnitaAccatastate,
          numeroUnitaScaldateCD:this.Progetto.condominioNumerounitariscaldate,
          numeroPertinnzeAccatastateCD:this.Progetto.condominioPertinenzaC2C6C7,
          condominioFormalmenteCostituitoCD:this.Progetto.condominioformalmenteCostituito,
          condominioUnicoProprietarioCD:this.Progetto.screeningCondominioUnicoProprietario,
          IRESCD:this.Progetto.screeningCondominioSoggettiIRES,
          mutliProprietaCD:this.Progetto.screeningCondominioPossiedonoMultiProprieta,
          condominioA1A8A9CD:this.Progetto.screeningCondominioA1A8A9,
          usufruito110CD:this.Progetto.screeningCondominioUsufruito110,
          cd_codicefiscale_condominio:this.Progetto.condominioFormalmenteCostituitoCodiceFsicale,
          cd_info_condominiocostituito:this.Progetto.condominioFormalmenteCostituitoRiferimentoAmministatore,

          elencoFile:this.Progetto.elencoAllegati,


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

    removeRow(index){
   this.elencoAnagraficaClienti.splice(index, 1)
    },
   
  

 
 
    },
     
  data () {
    return {
     nuovoProgetto:true,
     tab:'progetto',
     visualizzamessaggio:false,
     messaggioDaVisualizzare:false,
      staticTipoAllegato:{
        preventivoFirmato:'preventivoFirmato'

      },
     zonaClimatica:[],
      Progetto:{
        idprogetto:'',
        titoloProgetto:'',
        numeroCommessa:'',
        tipoCommessa:'',
        cercaAnagraficaClienti:'',
        elencoAnagraficaClienti:[],

        elencoCollaboratoriInterno:[],


        elencoCollaboratoriEnterno:[],
        //step2
        tipologiaEdificio:'',
        edificioUnifamiliareTipo:'',
        altroTipoEdificioFamiliare:'',
        NuovoProprietarioImmobileNome:'',
        NuovoProprietarioImmobileCognome:'',
        NuovoProprietarioImmobileCodiceFiscale:'',
        NuovoProprietarioImmobileTelefono:'',
        elencoProprietariImmobile:[],
        
        edificioUnifamiliareIndirizzo:'',
        edificioUnifamiliarecitta:'',
        edificioUnifamiliareProvincia:'',
        edificioUnifamiliareAnnocostruzione:'',
        edificioUnifamiliarePianoImmobile:' di cui fuori terra n° ',
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
        zonasismisca4:'',
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
        Base64AllegatoTitoloAutorizzativo:'',
        //annoIntervento:'',
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
        cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente:{value:'',label:'Seleziona..'},
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
        cetraleTermicaCentralizzatoTecnologiaImpiantoProposto:{value:'',label:'Seleziona..'},
        cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro:'',
        cetraleTermicaCentralizzatoNumeroUnitaProposte:'',
        cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto:'',
        centraleTermivaCentralizzatoVettoreImpianto:'',
        elencoImpiantoAutonomoEsistente:[],
        elencoImpiantoAutonomoEsistenteStatoDiProgetto:[],

        tipoAllegatodiAllegati:'',
        tipoAltroAllegato:'',
        noteallegatoDiallegati:'',
        nameAuxFile:'',
        auxFile:'',
        elencoAllegati:[],
        
        base64AllegatoPreventivo:'',
        quotaPreventivo:'',
        elencoQuote:[],
        elencoSpese:[],

        nuovoProgetto:true,
        elencoUtentiDaAutorizzare:[],
        elencoUtentiAutorizzati:[],



      },
   
    }
  },

  components: {

    step1,step2,step3,step4,step5,step6,autorizzaUtenti,wbs
  },
 
  props:['idprogetto'],
computed:{
    ...mapGetters({
      isAuth:'GET_AUTH',
      user:'GET_AUTH_USER',
      })
},
  beforeMount:function(){


   if (this.idprogetto >0){ 
/********** DETTAGLI PROGETTO **********/

    this.nuovoProgetto=false;
    this.Progetto.idprogetto=this.idprogetto;
Axios.get(this.linkApi+'/getProgetto/'+this.idprogetto).then(response =>{
//TODO PROBLEMA ALLEGATO
/* LISTA CLIENTI */
if (response.data['clienti'][0] != null){

 response.data['clienti'].forEach(element => {
   this.Progetto.elencoAnagraficaClienti.push({
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
   this.Progetto.elencoCollaboratoriEnterno.push({
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
   this.Progetto.elencoCollaboratoriInterno.push({
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
   this.Progetto.elencoAnagraficaProgettisti.push({
     nome:element.nome,
     cognome:element.cognome,
     codiceFiscale:element.codice_fiscale,
      });
   });
}
if (response.data['interventiSuccessivi'][0] != null){

 response.data['interventiSuccessivi'].forEach(element => {
   this.Progetto.elencoInterventiManutenzioneStraordinariaSCIACILAltro.push({
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
   this.Progetto.elencoTitoliAutorizzatiInterventiSuccessivi.push({
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
   this.Progetto.elencoTitoliAutorizzatiDatiCatastali.push({
     sub:element.sub,
     foglio:element.foglio, 
     particella:element.particella,
    });
   });
}
if (response.data['impiantoAutonomoDiFatto'][0] != null){

 response.data['impiantoAutonomoDiFatto'].forEach(element => {
   this.Progetto.elencoImpiantoAutonomoEsistente.push({
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
   this.Progetto.elencoImpiantoAutonomoEsistenteStatoDiProgetto.push({
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
   this.Progetto.elencoAllegati.push({
     id:element.id,
     nomeFile:element.nome_file,
     noteFile:element.note_allegato, 
     tipoAllegato:element.tipo_allegato,
     idprogetto:element.id_progetto,
     new:0,
     cancellare:0,
     });
     if (element.tipo_allegato == this.staticTipoAllegato.preventivoFirmato){
     
     this.Progetto.nameAuxFilePreventivo=element.nome_file;
     }
   });
}
if (response.data['quoteAcconti'][0] != null){

 response.data['quoteAcconti'].forEach(element => {
   this.Progetto.elencoQuote.push({
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
   this.Progetto.elencoSpese.push({
     dataPagamento:element.data,
     importo:element.importo, 
     causale:element.causale,
     chiHapagato:element.chi_ha_pagato,
    tipo_quota:element.tipo_quota,
     
     });
   });
}
if (response.data['listaUsersAssociatiAlProgetto'][0] != null){

 response.data['listaUsersAssociatiAlProgetto'].forEach(element => {
   this.Progetto.elencoUtentiAutorizzati.push({
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
this.Progetto.edificioUnifamiliareTipo=dettagliEdificio.ef_tipo_edificio;

this.Progetto.nuovoProgetto=false;
/* CONDOMINIO */
this.Progetto.condominioNome=dettagliEdificio.cd_nome_condominio;
this.Progetto.condominioIndirizzo=dettagliEdificio.cd_indirizzo;
this.Progetto.condominioCitta=dettagliEdificio.cd_citta;
this.Progetto.condominioProvincia=dettagliEdificio.cd_citta;
this.Progetto.condominioAnnodicotruzione=dettagliEdificio.cd_annocostruzione;
this.Progetto.condominioPianoimmboile=dettagliEdificio.cd_piano_immobile;
this.Progetto.condominioNumeroUnitaAccatastate=dettagliEdificio.cd_numero_ui_accatastate;
this.Progetto.condominioNumerounitariscaldate= dettagliEdificio.cd_numero_ui_riscaldate;
if (dettagliEdificio.cd_numero_pertinnze_accatastate != null){
var outputsplit = dettagliEdificio.cd_numero_pertinnze_accatastate.split(';');
if (outputsplit!=null){
   outputsplit.forEach(element=>{this.Progetto.condominioPertinenzaC2C6C7.push(element)});
}}
this.Progetto.condominioformalmenteCostituito=dettagliEdificio.cd_condominio_costituito;
if(dettagliEdificio.cd_condominio_costituito=='SI'){
this.Progetto.condominioFormalmenteCostituitoCodiceFsicale=dettagliEdificio.cd_codicefiscale_condominio;
this.Progetto.condominioFormalmenteCostituitoRiferimentoAmministatore=dettagliEdificio.cd_info_condominiocostituito;}
if(dettagliEdificio.cd_condominio_costituito=='NO'){
this.Progetto.condominioNOformalmenteCostituitoCodiceFiscaleReferente=dettagliEdificio.cd_codicefiscale_condominio;
this.Progetto.condominioNOformalmenteCostituitoReferente=dettagliEdificio.cd_info_condominiocostituito;}
/* SCREENIN CONDOMINIO */
this.Progetto.screeningCondominioUnicoProprietario=dettagliEdificio.cd_unico_proprietario ;
this.Progetto.screeningCondominioSoggettiIRES=dettagliEdificio.cd_ires;
this.Progetto.screeningCondominioPossiedonoMultiProprieta=dettagliEdificio.cd_condomini_altri_unita;
this.Progetto.screeningCondominioA1A8A9=dettagliEdificio.cd_a1a8a9;
this.Progetto.screeningCondominioUsufruito110= dettagliEdificio.cd_usufruito110;


/*FINE CONDOMINIO */



/* familiare */
if (response.data['infoelencoProprietariImmobile'][0] != null){
  var listaProprietari=response.data['infoelencoProprietariImmobile'];
listaProprietari.forEach(element =>{ this.Progetto.elencoProprietariImmobile.push(
         {nome:element.nome, 
         cognome:element.cognome,
        codiceFiscale:element.codicefiscale,
        telefono:element.telefono,
          });});
}
this.Progetto.edificioUnifamiliareTipo=dettagliEdificio.ef_tipo_edificio;
this.Progetto.edificioUnifamiliareIndirizzo=dettagliEdificio.ef_indirizzo;
this.Progetto.edificioUnifamiliarecitta=dettagliEdificio.ef_citta;
this.Progetto.edificioUnifamiliareProvincia=dettagliEdificio.ef_provincia;
this.Progetto.edificioUnifamiliareAnnocostruzione=dettagliEdificio.ef_annocostruzione;
this.Progetto.edificioUnifamiliarePianoImmobile=dettagliEdificio.ef_pianoImmobili;

/*screening familiare */
this.Progetto.screeningUnifamiliareIndipendente=dettagliEdificio.ef_indipendente;
this.Progetto.screeningUnifamiliareIAcessoAutonomo=dettagliEdificio.ef_accesso_autonomo;
this.Progetto.screeningUnifamiliareUsufruito110=dettagliEdificio.ef_usufruito_110;
this.Progetto.screeningUnifamiliareRiqualificazioneBalconi=dettagliEdificio.ef_riqualificazioni_balconi;



/* familiare */


}


/*DATI GENERICI PROGETTO */
  this.Progetto.titoloProgetto=response.data['progetto'][0].titolo_progetto;
  this.Progetto.numeroCommessa=response.data['progetto'][0].codice_commessa;
  this.Progetto.tipoCommessa=response.data['progetto'][0].tipo_commessa;
 this.Progetto.tipologiaEdificio = response.data['progetto'][0].tipologia_edificio;

    outputsplit= response.data['progetto'][0].zona_climatica.split(";");
   if (outputsplit!= null){
  outputsplit.forEach(element => {this.Progetto.zonaClimatica.push(element); });}
  //this.zonaClimatica = response.data['progetto'][0].zona_climatica;
  this.Progetto.gradigiornoText = response.data['progetto'][0].gradi_giorno ;
  this.Progetto.areavincolata42 = response.data['progetto'][0].areavincolata; 
  this.Progetto.areaVicnolata42TipoVincolo = response.data['progetto'][0].tipo_vincolo; 
  this.Progetto.zonasismisca4 = response.data['progetto'][0].zonasismisca ;
  this.Progetto.zonasismisca4Interventiantisismici = response.data['progetto'][0].interventi_antisismici ;
  this.Progetto.zonasismisca4InterventiantisismiciAltriVincoli = response.data['progetto'][0].interventi_sismici_altri_vincoli ;
  if (response.data['progetto'][0].TipoInterventoProposto != null){
  outputsplit= response.data['progetto'][0].TipoInterventoProposto.split(";");
  if (outputsplit!= null){
  outputsplit.forEach(element => {this.Progetto.TipoInterventoProposto.push(element); });}}
if (response.data['progetto'][0].TipologiainterventoDPR3802001 != null){
  outputsplit= response.data['progetto'][0].TipologiainterventoDPR3802001.split(";");
  if (outputsplit != null){
   outputsplit.forEach(element => {this.Progetto.TipologiainterventoDPR3802001.push(element); });
  }
  }
  this.Progetto.tipologiaTitoloAutorizzativi= response.data['progetto'][0].tipologiaTitoloAutorizzativi;
  this.Progetto.riferimentiAutorizzativi= response.data['progetto'][0].riferimentiAutorizzativi;
  this.Progetto.dateAutorizzativi= response.data['progetto'][0].dateAutorizzativi;
  this.Progetto.AllegatoTitoloAutorizzativo=response.data['progetto'][0].AllegatoTitoloAutorizzativo;
  this.Progetto.pathAllegatoTitoloAutorizzativo= this.linkApi+'/'+this.idprogetto+'/'+this.Progetto.AllegatoTitoloAutorizzativo;
  this.Progetto.abusiEdilizi= response.data['progetto'][0].abusiEdilizi;
  this.Progetto.TipologiaAbusiEdilizi = response.data['progetto'][0].TipologiaAbusiEdilizi;
  this.Progetto.comuneStatoDiFatto = response.data['progetto'][0].comuneStatoDiFatto;
  this.Progetto.NCEUStatoDiFatto = response.data['progetto'][0].NCEUStatoDiFatto;
  this.Progetto.difformitaUrbanistiche = response.data['progetto'][0].difformitaUrbanistiche;
  this.Progetto.noteDifformitaUrbanistiche = response.data['progetto'][0].noteDifformitaUrbanistiche;
  this.Progetto.difformitaCatastali = response.data['progetto'][0].difformitaCatastali;
  this.Progetto.noteDifformitaCatastali= response.data['progetto'][0].noteDifformitaCatastali;
  this.Progetto.irregolaritaSanabili= response.data['progetto'][0].irregolaritaSanabili;
  this.Progetto.noteIrregolaritaSanabili= response.data['progetto'][0].noteIrregolaritaSanabili;

  if (response.data['progetto'][0].tipologia_struttura_edificiio != null){
   outputsplit= response.data['progetto'][0].tipologia_struttura_edificiio.split(";");
  
   outputsplit.forEach(element => {this.Progetto.datistrutturalichk.push(element); });
  }
  this.Progetto.altroDatiStrutturali = response.data['progetto'][0].altroDatiStrutturali;
  
  if (response.data['progetto'][0].tipologia_parete != null){
   outputsplit= response.data['progetto'][0].tipologia_parete.split(";");
   outputsplit.forEach(element => {this.Progetto.tipologiaParetechk.push(element); });
  }

  this.Progetto.altroTipologiaParetechk = response.data['progetto'][0].altroTipologiaParetechk;
 if ( response.data['progetto'][0].tipologia_doppia_parete  != null){
   outputsplit= response.data['progetto'][0].tipologia_doppia_parete.split(";");
   outputsplit.forEach(element => {this.Progetto.tipologia_doppia_parete.push(element); });
  }
  this.Progetto.SpessoreMuriEsterni = response.data['progetto'][0].spessori_muri_esternicm;
  this.Progetto.SpessoreCameraDaria = response.data['progetto'][0].spessori_camera_ariacm;
  this.Progetto.SpessoreIsolamento = response.data['progetto'][0].spessore_isolamentocm;
  this.Progetto.TipologiaIsolamentoIncameraDaria = response.data['progetto'][0].tipo_isolamento_camera_aria;
  if (response.data['progetto'][0].cappotto != null){
  outputsplit= response.data['progetto'][0].cappotto.split(";");
  
   outputsplit.forEach(element => {this.Progetto.isolamentoEsistentechk.push(element); });
  }
  this.Progetto.altroisolamentoEsistentechk= response.data['progetto'][0].altroisolamentoEsistente;
  this.Progetto.tipologiaImpiantoEsistente = response.data['progetto'][0].centraletermicaesistente_tipo_impianto;
  /* centrale termina centralizzato */

  this.Progetto.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente={value: response.data['progetto'][0].centraletermicaesistente_tecnologia_impianto};
  this.Progetto.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro= response.data['progetto'][0].cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro;
  this.Progetto.cetraleTermicaCentralizzatoNumeroUnita= response.data['progetto'][0].centraletermicaesistente_numero_unita_generazione;
  this.Progetto.cetraleTermicaCentralizzatoAnnoInstallazione= response.data['progetto'][0].centraletermicaesistente_anno_installazione;
  this.Progetto.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente= response.data['progetto'][0].centraletermicaesistente_potenza_termica;
  this.Progetto.cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste= response.data['progetto'][0].centraletermicaesistente_tipologia_distribuzione;
  this.Progetto.cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente= response.data['progetto'][0].centraletermicaesistente_tipologia_termoregolazione;
  this.Progetto.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato=response.data['progetto'][0].centraletermicaesistente_libretto_impianto_aggiornato;
  this.Progetto.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate= response.data['progetto'][0].centraletermicaesistente_provefumi;
  this.Progetto.cetraleTermicaCentralizzatoCertificatoCPI=response.data['progetto'][0].centraletermicaesistente_cpi;
  this.Progetto.cetraleTermicaCentralizzatoTecnologiaImpiantoProposto={value: response.data['progetto'][0].centraletermicaprogetto_tecnologia_esistente};
  this.Progetto.cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro=response.data['progetto'][0].centraletermicaprogetto_tecnologia_esistente_altro;
  this.Progetto.cetraleTermicaCentralizzatoNumeroUnitaProposte=response.data['progetto'][0].centraletermicaprogetto_numero_unita;
  this.Progetto.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto=response.data['progetto'][0].centraletermicaprogetto_potenza_termica;
  this.Progetto.centraleTermivaCentralizzatoVettoreImpianto=response.data['progetto'][0].centraletermicaprogetto_vettore_energetico;
  this.Progetto.quotaPreventivo= response.data['progetto'][0].quota_preventivo;
  
})

  }else{
    this.nuovoProgetto=true;
  }
  }

}
</script>