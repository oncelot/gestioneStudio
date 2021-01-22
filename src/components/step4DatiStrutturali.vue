<template>
    <div>

<div class="bgmargintop">
  <div class="row"><div class="col-12"><span class="text-h6 text-secondary">Dati strutturali</span></div></div>
  <div class="row">
    <div class="col-12">
    <strong>Tipologia struttura edificio:</strong>
    </div>
  
    <div class="col-3"><q-checkbox right-label v-model="value.datistrutturalichk" val="EdificioinMuraturaPortante" label="Edificio in Muratura Portante" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.datistrutturalichk" val="EdificioTelaioCAinopera" label="Edificio con telaio in C.A. in opera" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.datistrutturalichk" val="EdificioElementiPrefabbricati" label="Edificio con elementi prefabbricati" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.datistrutturalichk" val="altro" label="Altro" /></div>


  </div>
  <div class="row" v-if="value.datistrutturalichk.includes('altro')">
    <div class="col">
      <q-input v-model="value.altroDatiStrutturali" type="text" :dense="true" outlined label="Altro" />
      </div>
    </div>
 
  <div class="row">
    <div class="col-12">
    <strong>Tipologia parete:</strong>
   
    </div>
   
    <div class="col-3"><q-checkbox right-label v-model="value.tipologiaParetechk" val="Laterizio" label="Laterizio" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.tipologiaParetechk" val="MuraturaCassaVuota" label="Muratura a cassa vuota" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.tipologiaParetechk" val="MuraturaCassaIsolanteIntercapedine" label="Muratura a cassa con isolante in intercapedine" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.tipologiaParetechk" val="Tufo" label="Tufo" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.tipologiaParetechk" val="Gasbeton" label="Gasbeton" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.tipologiaParetechk" val="altro" label="Altro" /></div>


  </div>
  <div class="row" v-if="value.tipologiaParetechk.includes('altro')">
    <div class="col">
      <q-input v-model="value.altroTipologiaParetechk" type="text" :dense="true" outlined label="Altro" /></div></div>

 <div class="row">
    <div class="col-12">
    <strong>Tipologia FOTO COSA FARE:</strong>
    </div>
   
    <div class="col-3"><q-checkbox right-label v-model="value.tipologia_doppia_parete" val="presenzaIntercapedite" label="Presenza intercapedine/camera d’aria" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.tipologia_doppia_parete" val="IsolamentoInCameraDaria" label="Isolante in camera d’aria (sughero, EPS, ecc…)" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.tipologia_doppia_parete" val="idoneoInsuffiaggio" label=" Idoneo a insufflaggio" /></div>
    <div class="row">
    <div class="col-4 paddingInput">
    <label for="">Spessori muri esterni (cm)</label>
    <q-input v-model="value.SpessoreMuriEsterni" type="text" outlined :dense="true"/>
    </div>
    <div class="col-4 paddingInput">
    <label for="">Spessoricamera d'aria (cm)</label>
    <q-input v-model="value.SpessoreCameraDaria" type="text" outlined :dense="true"/>
    </div>
    <div class="col-4 paddingInput">
    <label for="">Spessori Isolamento (cm)</label>
    <q-input v-model="value.SpessoreIsolamento" type="text" outlined :dense="true"/>
    </div>
    <div class="col-4 paddingInput">
    <label for="">Tipo isolante in camera d’aria</label>
    <q-input v-model="value.TipologiaIsolamentoIncameraDaria" type="text" outlined :dense="true"/>
    </div>
   </div>

  </div>

 <div class="row">
    <div class="col-12">
    <strong>Eventuale Isolante esistente(cappotto):</strong>
    </div>
   
    <div class="col-3"><q-checkbox right-label v-model="value.isolamentoEsistentechk" val="eps" label="EPS" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.isolamentoEsistentechk" val="sughero" label="Sughero" /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.isolamentoEsistentechk" val="lanaDiroccaVetro" label="Lana di roccia/vetro " /></div>
    <div class="col-3"><q-checkbox right-label v-model="value.isolamentoEsistentechk" val="altro" label="Altro" /></div>
    


  </div>
  <div class="row" v-if="value.isolamentoEsistentechk.includes('altro')">
    <div class="col">
      <q-input v-model="value.altroisolamentoEsistentechk" type="text" :dense="true" outlined label="Altro" />
      </div>
    </div>
</div>

<div class="bgmargintop">
<div class="row" style="padding-top:20px"><div class="col"><span class="text-h6 text-secondary">Dati Centrale Termina</span></div></div>

<div class="row"><div class="col-12">
  <label class="text-bold">Tipologia Impianto esistente</label></div>
  <div class="col-12">
    <q-radio v-model="value.tipologiaImpiantoEsistente" val="centralizzato" label="Centralizzato" />
    <q-radio v-model="value.tipologiaImpiantoEsistente" val="autonomo" label="autonomo" />
    <q-radio v-model="value.tipologiaImpiantoEsistente" val="assente" label="assente" />
    
    </div>
  </div>

<!-- #region CENTRALIZZATO -->
  <div  v-if="value.tipologiaImpiantoEsistente == 'centralizzato'">
<div class="row"><div class="col"><span class="text-bold">Stato di fatto</span></div></div>
<div class="row">
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold" >Tecnologia impianto esistente</label>
 
  <q-select v-model="value.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente" :dense='true' outlined :options="tecnologieCentraliTermiche"  />

  <q-input v-show="value.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente.value == 'altro' " v-model="value.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro" outlined :dense="true" type="text" label="Specificare"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Numero unità di generazione</label>
  <q-input v-model="value.cetraleTermicaCentralizzatoNumeroUnita" outlined :dense="true" type="text"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Anno di installazionee</label>
  <q-input v-model="value.cetraleTermicaCentralizzatoAnnoInstallazione" outlined :dense="true" type="text"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Potenza termica utile impianto esistente [kWt]</label>
  <q-input v-model="value.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente" outlined :dense="true" type="text"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Tipologia di distribuzione esistente</label>
  <q-input v-model="value.cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste" outlined :dense="true" type="text"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Tipologia sistema di termoregolazione evoluta</label>
  <q-input v-model="value.cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente" outlined :dense="true" type="text"  />
  
  </div>
  <div class="col-md-12 col-12">
    <label for="" class="text-bold">Disponibilità libretto di impianto aggiornato</label><br>
    <q-radio v-model="value.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato" val="SI" label="SI" />
    <q-radio v-model="value.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato" val="NO" label="NO" />
    <q-radio v-model="value.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato" val="Assente" label="Assente" />
    <div v-if="value.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato == 'SI'">
      <q-file
      v-model="value.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato"
      label="allegare copia libretto "
      outlined
      :dense="true"
      style="max-width: 300px" />

      </div>
  </div>
  <div class="col-md-12 col-12">
    <label for="" class="text-bold">Disponibilità prove fumi aggiornate</label><br>
    <q-radio v-model="value.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate" val="SI" label="SI" />
    <q-radio v-model="value.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate" val="NO" label="NO" />
    <q-radio v-model="value.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate" val="Assente" label="Assente" />
    <div v-if="value.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate == 'SI'">
       <q-file
      v-model="value.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato"
      label="allegare copia libretto "
      outlined
      :dense="true"
      style="max-width: 300px" />
      QUI PURE ALLEGATI?</div>
  </div>
  <div class="col-md-12 col-12">
    <label for="" class="text-bold">Disponibilità Certificato Prevenzione Incendi (CPI) aggiornato</label><br>
    <q-radio v-model="value.cetraleTermicaCentralizzatoCertificatoCPI" val="SI" label="SI" />
    <q-radio v-model="value.cetraleTermicaCentralizzatoCertificatoCPI" val="NO" label="NO" />
    <q-radio v-model="value.cetraleTermicaCentralizzatoCertificatoCPI" val="Assente" label="Assente" />
    <div v-if="value.cetraleTermicaCentralizzatoCertificatoCPI == 'SI'">
       <q-file
      v-model="value.cetraleTermicaCentralizzatoCertificatoCPIAllegato"
      label="allegare copia libretto "
      outlined
      :dense="true"
      style="max-width: 300px" />
      
      
      QUI PURE ALLEGATI?</div>
  </div>
</div>
<div class="row"><div class="col text-bold text-h5 primary" >Stato di Progetto</div></div>
<div class="row">
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold" >Tecnologia impianto esistente</label>

  <q-select v-model="value.cetraleTermicaCentralizzatoTecnologiaImpiantoProposto" :dense='true' outlined :options="tecnologieCentraliTermiche"  />

  <q-input v-show="value.cetraleTermicaCentralizzatoTecnologiaImpiantoProposto.value == 'altro' " v-model="value.cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro" outlined :dense="true" type="text" label="Specificare"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Numero unità di generazione</label>
  <q-input v-model="value.cetraleTermicaCentralizzatoNumeroUnitaProposte" outlined :dense="true" type="text"  />
  
  </div>

  <div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Potenza termica utile impianto esistente [kWt]</label>
  <q-input v-model="value.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto" outlined :dense="true" type="text"  />
  
  </div>

<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Vettore energetico impianto</label>
  <q-input v-model="value.centraleTermivaCentralizzatoVettoreImpianto" outlined :dense="true" type="text"  />
  
  </div>

  </div>

    </div>
     <div  v-if="value.tipologiaImpiantoEsistente == 'autonomo'">
    <div class="row"><div class="col"><span class="text-bold text-h5">Stato di fatto</span></div></div>
    <div class="row"><div class="col">
      <q-btn  class="white" icon="add" label="Aggiungi" @click="modalAggiungiImpiantoEsistenteAutonomo=true" /><!--TODO CAMBIARE CLICK BOTTONE MODAL -->
      
      </div></div>
      <div class="row" style="border-bottom:1px solid black">
  <div class="col">Sub</div>
  <div class="col">Tecnologia impianto1</div>
  <div class="col">N. unità di generazione</div>
  <div class="col">Tipologia sistema di termoregolazione</div>
  <div class="col">Potenza termica utile [kW]</div>
  <div class="col">Anno installazione</div>
  <div class="col">Generatore oggetto di sostituzione?</div> 
  <div class="col-1 col-md-1 ">  </div>
  </div>

 <div  class="row" v-for="(item,index) in value.elencoImpiantoAutonomoEsistente" :key="item.message" style="border-bottom:1px solid black">
     <div class="col"> {{ item.sub }}</div>
     <div class="col"> {{ item.tecnologiaImpianto }}</div>
     <div class="col"> {{ item.numeronUnitaGenerazione }}</div>
     <div class="col"> {{ item.tipologiaSistemaTermoregolazione }}</div>
     <div class="col"> {{ item.potenzaTermicaUtile }}</div>
     <div class="col"> {{ item.annoInstallazione }}</div>
     <div class="col"> {{ item.GeneratoreOggettoDiSostituzione }}</div>
    <div class="col-1 col-md-1 "> 
    <q-btn   size="sm" round icon="delete" @click="value.elencoImpiantoAutonomoEsistente.splice(index, 1)" />
  
  </div>
  </div>
    <div class="row"><div class="col"><span class="text-bold text-h5">Stato di Progetto</span></div></div>
    <div class="row"><div class="col">
      <q-btn  class="white" icon="add" label="Aggiungi" @click="modalAggiungiImpiantoEsistenteAutonomoStatoProgetto=true" /><!--TODO CAMBIARE CLICK BOTTONE MODAL -->
      
      </div></div>
<div class="row" style="border-bottom:1px solid black">
  <div class="col">Sub</div>
  <div class="col">Tecnologia impianto</div>
  <div class="col">N. unità di generazione</div>
  <div class="col">Tipologia sistema di termoregolazione</div>
  <div class="col">Potenza termica utile [kW]</div>
  <div class="col">Anno installazione</div>
  <div class="col">Generatore oggetto di sostituzione?</div>
  <div class="col-1 col-md-1 "></div>
  </div>

 <div  class="row" v-for="(item,index) in value.elencoImpiantoAutonomoEsistenteStatoDiProgetto" :key="item.message" style="border-bottom:1px solid black">
     <div class="col"> {{ item.sub }}</div>
     <div class="col"> {{ item.tecnologiaImpianto }}</div>
     <div class="col"> {{ item.numeronUnitaGenerazione }}</div>
     <div class="col"> {{ item.tipologiaSistemaTermoregolazione }}</div>
     <div class="col"> {{ item.potenzaTermicaUtile }}</div>
     <div class="col"> {{ item.annoInstallazione }}</div>
     <div class="col"> {{ item.GeneratoreOggettoDiSostituzione }}</div>
    <div class="col-1 col-md-1 "> 
    <q-btn   size="sm" round icon="delete" @click="value.elencoImpiantoAutonomoEsistenteStatoDiProgetto.splice(index, 1)" />
  
  </div>
  </div>

  </div>
</div>
<q-dialog v-model="modalAggiungiImpiantoEsistenteAutonomo" persistent>
  <q-card>
    <q-card-section class="row items-center">
     
      <span class="q-ml-md">Aggiungi</span>
    </q-card-section>
    <q-card-section class="row items-center">
    
      <span class="q-ml-md">
          
        <q-input v-model="NuovoImpiantoEsistenteAutonomosub" type="text" label="sub" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomotecnologiaImpianto" type="text" label="Tecnologia impianto" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione" type="number" label="N. unità di generazione" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione" type="text" label="Tipologia sistema di termoregolazione" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile" type="number" label="Potenza termica utile [kW]" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomoannoInstallazione" type="number" label="Anno installazione" />
        <label class="text-bold">Generatore oggetto di sostituzione?</label>
        <q-radio v-model="NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione" val="SI" label="SI" />
        <q-radio v-model="NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione" val="NO" label="NO" />
        
       
       
        </span>
    </q-card-section>
    <q-card-actions align="right">
      <q-btn flat label="Annulla" color="primary" v-close-popup />
      <q-btn flat label="Conferma" color="primary" @click="addrowImpiantoAutonomoEsistente();"/>
    </q-card-actions>
  </q-card>
</q-dialog>

<q-dialog v-model="modalAggiungiImpiantoEsistenteAutonomoStatoProgetto" persistent>
  <q-card>
    <q-card-section class="row items-center">
     
      <span class="q-ml-md">Aggiungi</span>
    </q-card-section>
    <q-card-section class="row items-center">
    
      <span class="q-ml-md">
          
        <q-input v-model="NuovoImpiantoEsistenteAutonomosub" type="text" label="sub" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomotecnologiaImpianto" type="text" label="Tecnologia impianto" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione" type="text" label="N. unità di generazione" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione" type="text" label="Tipologia sistema di termoregolazione" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile" type="text" label="Potenza termica utile [kW]" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomoannoInstallazione" type="text" label="Anno installazione" />
        <label class="text-bold">Generatore oggetto di sostituzione?</label>
        <q-radio v-model="NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione" val="SI" label="SI" />
        <q-radio v-model="NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione" val="NO" label="NO" />
        
       
       
        </span>
    </q-card-section>
    <q-card-actions align="right">
      <q-btn flat label="Annulla" color="primary" v-close-popup />
      <q-btn flat label="Conferma" color="primary" @click="addrowImpiantoAutonomoEsistenteStatoProgetto();"/>
    </q-card-actions>
  </q-card>
</q-dialog>


</div>
</template>
<script>
export default {
    data(){return {
        tecnologieCentraliTermiche:[
          {
            label:'Caldaia a gas',
            value:'CaldaiaGas'
          },
          {
            label:'caldaia a condensazione',
            value:'caldaiaCondensazione'
          },
          {
            label:'pompa di calore',
            value:'pompaDiCalore'
          },
          {
            label:'caldaia a gasolio',
            value:'caldaiaGasolio'
          },
          {
            label:'altro (specificare)',
            value:'altro'
          }
      ],
      modalAggiungiImpiantoEsistenteAutonomo:false,
      modalAggiungiImpiantoEsistenteAutonomoStatoProgetto:false,
         NuovoImpiantoEsistenteAutonomosub:'', NuovoImpiantoEsistenteAutonomotecnologiaImpianto:'',NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione:'',NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione:'',
          NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile:'',NuovoImpiantoEsistenteAutonomoannoInstallazione:'',NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione:'',
       
    }},
    props:['value'],
    methods:{
          addrowImpiantoAutonomoEsistente(){
      this.value.elencoImpiantoAutonomoEsistente.push(
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

      this.modalAggiungiImpiantoEsistenteAutonomo= false;
    },

    addrowImpiantoAutonomoEsistenteStatoProgetto(){
      this.value.elencoImpiantoAutonomoEsistenteStatoDiProgetto.push(
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
this.NuovoImpiantoEsistenteAutonomosub='';
           this.NuovoImpiantoEsistenteAutonomotecnologiaImpianto='';
           this.NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione='';
           this.NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione='';
           this.NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile='';
            this.NuovoImpiantoEsistenteAutonomoannoInstallazione='';
           this.NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione='';
           
      this.modalAggiungiImpiantoEsistenteAutonomoStatoProgetto= false;
      
    },
    }
}
</script>